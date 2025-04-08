<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Genre;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class AdminSongController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 15);

        $query = Album::query()->with('artist'); // eager load artist relationship

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search by title or artist name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhereHas('artist', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%$search%");
                    });
            });
        }

        $albums = $query->latest()->paginate($perPage);

        return view('admin.albums.index', compact('albums'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,pending,inactive',
            'release_date' => 'nullable|date',
            'artist_id' => 'required|exists:users,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $uuid = (string) Str::uuid();
        $coverImagePaths = null;

        if ($request->hasFile('cover_image')) {
            $imageFile = $request->file('cover_image');
            $filename = 'cover_' . $uuid . '.' . $imageFile->getClientOriginalExtension();

            $manager = new ImageManager(new Driver()); // GD driver
            $image = $manager->read($imageFile->getRealPath());

            // Store in 3 sizes
            $lgPath = 'albums/' . $filename;
            $mdPath = 'albums/' . str_replace('.', '_md.', $filename);
            $smPath = 'albums/' . str_replace('.', '_sm.', $filename);

            // Resize and save
            Storage::disk('public')->put($lgPath, (string) $image->scale(1024)->encode()); // large 1024px
            Storage::disk('public')->put($mdPath, (string) $image->scale(600)->encode());  // medium 600px
            Storage::disk('public')->put($smPath, (string) $image->scale(300)->encode());  // small 300px

            $coverImagePaths = 'storage/' . $lgPath . ',' . 'storage/' . $mdPath . ',' . 'storage/' . $smPath;
        }

        Album::create([
            'id' => $uuid,
            'artist_id' => $request->artist_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'cover_image' => $coverImagePaths,
            'release_date' => $request->release_date,
        ]);

        activity('album')
            ->withProperties(['ip' => request()->ip()])
            ->log(Auth::user()->name . ' created an album');

        return redirect()->route('admin.albums.index')->with('success', 'Album successfully added.');
    }

    public function update(Request $request, Album $album)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,pending,inactive',
            'release_date' => 'nullable|date',
            'artist_id' => 'required|exists:users,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $coverPaths = $album->cover_image; // Keep current if no new image uploaded

        // If new cover image is uploaded
        if ($request->hasFile('cover_image')) {
            // Delete old images
            if ($album->cover_image) {
                $paths = explode(',', $album->cover_image);
                foreach ($paths as $path) {
                    $relativePath = str_replace('storage/', '', $path); // storage/albums/xxx.jpg -> albums/xxx.jpg
                    Storage::disk('public')->delete($relativePath);
                }
            }

            $image = $request->file('cover_image');
            $ext = $image->getClientOriginalExtension();
            $uuid = (string) Str::uuid();
            $baseName = 'cover_' . $uuid;
            $folder = 'albums/';

            // Large (1024px)
            $lgName = $baseName . '.' . $ext;
            $lgImage = Image::make($image)->resize(1024, null, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            })->encode($ext);
            Storage::disk('public')->put($folder . $lgName, $lgImage);

            // Medium (400px)
            $mdName = $baseName . '_md.' . $ext;
            $mdImage = Image::make($image)->resize(400, 400, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            })->encode($ext);
            Storage::disk('public')->put($folder . $mdName, $mdImage);

            // Small (200px)
            $smName = $baseName . '_sm.' . $ext;
            $smImage = Image::make($image)->resize(200, 200, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            })->encode($ext);
            Storage::disk('public')->put($folder . $smName, $smImage);

            // Save paths
            $coverPaths = 'storage/' . $folder . $lgName . ',' .
                'storage/' . $folder . $mdName . ',' .
                'storage/' . $folder . $smName;
        }

        // Update the album
        $album->update([
            'artist_id' => $request->artist_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'release_date' => $request->release_date,
            'cover_image' => $coverPaths,
        ]);

        activity('album')
            ->withProperties(['ip' => request()->ip()])
            ->log(Auth::user()->name . ' updated album: ' . $album->title);

        return redirect()->route('admin.albums.index')->with('success', 'Album successfully updated.');
    }

    public function destroy(Album $album)
    {
        // Delete cover image files if they exist
        if ($album->cover_image) {
            $paths = explode(',', $album->cover_image);
            foreach ($paths as $path) {
                $relativePath = str_replace('storage/', '', $path);
                Storage::disk('public')->delete($relativePath);
            }
        }

        // 🗑 Delete the album record
        $album->delete();

        // Log the activity
        activity('album')
            ->withProperties(['ip' => request()->ip()])
            ->log(Auth::user()->name . ' deleted album: ' . $album->title);

        return redirect()->route('admin.albums.index')->with('success', 'Album successfully deleted.');
    }
}
