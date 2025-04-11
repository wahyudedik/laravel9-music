<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Genre;
use App\Models\Song;
use App\Models\ComposerSong;
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

        $query = Song::with(['artist', 'album', 'genre', 'composers']);

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        if ($request->has('fstatus') && $request->fstatus) {
            $query->where('status', $request->fstatus);
        }

        // Filter by search keyword
        if ($request->has('search') && $request->search) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('status', 'like', "%$search%")
                    ->orWhereHas('artist', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%$search%");
                    })
                    ->orWhereHas('album', function ($q3) use ($search) {
                        $q3->where('title', 'like', "%$search%");
                    })
                    ->orWhereHas('genre', function ($q4) use ($search) {
                        $q4->where('name', 'like', "%$search%");
                    })
                    ->orWhereHas('composers', function ($q5) use ($search) {
                        $q5->where('name', 'like', "%$search%");
                    });
            });
        }

        $album = null;
        if ($request->has('falbum_id') && $request->falbum_id) {
            $query->where('album_id', $request->falbum_id);
            $album = Album::where('id', $request->falbum_id)->first();
        }

        $genre = null;
        if ($request->has('fgenre_id') && $request->fgenre_id) {
            $query->where('genre_id', $request->fgenre_id);
            $genre = Genre::where('id', $request->fgenre_id)->first();
        }

        $songs = $query->latest()->paginate($perPage)->appends($request->only('search', 'status', 'perPage'));

        return view('admin.songs.index', compact('songs', 'genre', 'album'));
    }


    public function create()
    {
        $authUser = Auth::user();
        activity()->withProperties(['ip' => request()->ip()])->log($authUser->name . ' visited create songs form');

        return view('admin.songs.create');
    }

    public function store(Request $request)
    {

        try {

            $request->validate([
                'title' => 'required|string|max:255',
                'version' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'genre_id' => 'required|exists:genres,id',
                'album_id' => 'required|exists:albums,id',
                'artist_id' => 'required|exists:users,id',
                'cover_creator_id' => 'nullable|exists:users,id',
                'cover_version' => 'nullable|string|max:255',
                'license_type' => 'required|in:Full License,Royalty,Free',
                'license_price' => 'nullable|numeric',
                'license_file' => 'nullable|file|mimes:pdf,doc,docx',
                'allow_cover_version' => 'required|boolean',
                'allow_commercial_use' => 'required|boolean',
                'release_date' => 'required|date',
                'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'file_path' => 'required|file|mimes:mp3,wav,flac|max:10240',
                'duration' => 'nullable|integer',
                'status' => 'required|in:Active,Inactive,Pending',
                'composer_ids' => 'nullable|array',
                'composer_ids.*' => 'exists:users,id',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {

            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        }



        $uuid = (string) Str::uuid();
        $coverImagePaths = null;
        $licenseFilePath = null;
        $audioFilePath = null;

        if ($request->hasFile('cover_image')) {
            $imageFile = $request->file('cover_image');
            $filename = 'cover_' . $uuid . '.' . $imageFile->getClientOriginalExtension();

            $manager = new ImageManager(new Driver());
            $image = $manager->read($imageFile->getRealPath());

            $lgPath = 'songs/' . $filename;
            $mdPath = 'songs/' . str_replace('.', '_md.', $filename);
            $smPath = 'songs/' . str_replace('.', '_sm.', $filename);

            Storage::disk('public')->put($lgPath, (string) $image->scale(1024)->encode());
            Storage::disk('public')->put($mdPath, (string) $image->scale(600)->encode());
            Storage::disk('public')->put($smPath, (string) $image->scale(300)->encode());

            $coverImagePaths = 'storage/' . $lgPath . ',' . 'storage/' . $mdPath . ',' . 'storage/' . $smPath;
        }

        if ($request->hasFile('license_file')) {
            $licenseFile = $request->file('license_file');
            $licenseFilename = 'license_' . $uuid . '.' . $licenseFile->getClientOriginalExtension();
            $licenseFilePath = $licenseFile->storeAs('songs/licenses', $licenseFilename, 'public');
        }

        if ($request->hasFile('file_path')) {
            $audioFile = $request->file('file_path');
            $audioFilename = 'audio_' . $uuid . '.' . $audioFile->getClientOriginalExtension();
            $audioFilePath = $audioFile->storeAs('songs/audio', $audioFilename, 'public');
        }

        $song = Song::create([
            'id' => $uuid,
            'title' => $request->title,
            'version' => $request->version ?? 'original',
            'description' => $request->description,
            'genre_id' => $request->genre_id,
            'album_id' => $request->album_id,
            'artist_id' => $request->artist_id,
            'cover_creator_id' => $request->cover_creator_id,
            'cover_version' => $request->cover_version,
            'license_type' => $request->license_type,
            'license_price' => $request->license_price,
            'license_file' => $licenseFilePath ? 'storage/' . $licenseFilePath : null,
            'allow_cover_version' => $request->allow_cover_version,
            'allow_commercial_use' => $request->allow_commercial_use,
            'release_date' => $request->release_date,
            'cover_image' => $coverImagePaths,
            'file_path' => $audioFilePath ? 'storage/' . $audioFilePath : null,
            'duration' => $request->duration,
            'status' => $request->status,
        ]);

        if ($request->composer_ids) {
            $song->composers()->attach($request->composer_ids);
        }

        activity('song')
            ->withProperties(['ip' => request()->ip()])
            ->log(Auth::user()->name . ' created a song');

        return redirect()->route('admin.songs.index')->with('success', 'Song successfully added.');
    }


    public function edit(Request $request, $id)
    {
        $authUser = Auth::user();

        // Ambil data lagu lengkap dengan relasinya
        $song = Song::with(['album', 'artist', 'genre', 'coverCreator', 'composers'])->findOrFail($id);

        $composers = [];
        foreach ($song->composers as $composer) {
            $composers[] = [
                'id' => $composer->id,
                'name' => $composer->name,
                'roleName' => 'Composer',
            ];
        }
        $genre = [
            'id' => $song->genre->id,
            'name' => $song->genre->name,
        ];
        $artist = [
            'id' => $song->genre->id,
            'name' => $song->genre->name,
            'roleName' => 'Artist',
        ];
        $album = [
            'id' => $song->album->id,
            'title' => $song->album->title,
            'artist' => $song->album->artist->name,
        ];


        activity('song')
            ->withProperties(['ip' => request()->ip()])
            ->log($authUser->name . ' visited edit song form for song: ' . $song->title);

        return view('admin.songs.edit', compact('song', 'composers', 'genre', 'artist', 'album'));
    }

    public function update(Request $request, Song $song)
    {

        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'version' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'genre_id' => 'required|exists:genres,id',
                'album_id' => 'required|exists:albums,id',
                'artist_id' => 'required|exists:users,id',
                'cover_creator_id' => 'nullable|exists:users,id',
                'cover_version' => 'nullable|string|max:255',
                'license_type' => 'required|in:Full License,Royalty,Free',
                'license_price' => 'nullable|numeric',
                'license_file' => 'nullable|file|mimes:pdf,doc,docx',
                'allow_cover_version' => 'required|boolean',
                'allow_commercial_use' => 'required|boolean',
                'release_date' => 'required|date',
                'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'file_path' => 'nullable|file|mimes:mp3,wav,flac|max:10240',
                'duration' => 'nullable|integer',
                'status' => 'required|in:Active,Inactive,Pending',
                'composer_ids' => 'nullable|array',
                'composer_ids.*' => 'exists:users,id',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        $coverImagePaths = $song->cover_image;
        $licenseFilePath = $song->license_file;
        $audioFilePath = $song->file_path;

        if ($request->hasFile('cover_image')) {


            // Hapus cover lama jika ada
            if ($song->cover_image) {
                $oldPaths = explode(',', $song->cover_image);
                foreach ($oldPaths as $path) {
                    $cleanPath = str_replace('storage/', '', $path);
                    if (Storage::disk('public')->exists($cleanPath)) {
                        Storage::disk('public')->delete($cleanPath);
                    }
                }
            }

            $uuid = $song->id;
            $imageFile = $request->file('cover_image');
            $filename = 'cover_' . $uuid . '.' . $imageFile->getClientOriginalExtension();

            $manager = new ImageManager(new Driver());
            $image = $manager->read($imageFile->getRealPath());

            $lgPath = 'songs/' . $filename;
            $mdPath = 'songs/' . str_replace('.', '_md.', $filename);
            $smPath = 'songs/' . str_replace('.', '_sm.', $filename);

            Storage::disk('public')->put($lgPath, (string) $image->scale(1024)->encode());
            Storage::disk('public')->put($mdPath, (string) $image->scale(600)->encode());
            Storage::disk('public')->put($smPath, (string) $image->scale(300)->encode());

            $coverImagePaths = 'storage/' . $lgPath . ',' . 'storage/' . $mdPath . ',' . 'storage/' . $smPath;
        }

        if ($request->hasFile('license_file')) {

            // Hapus file lama
            if ($song->license_file) {
                $oldLicensePath = str_replace('storage/', '', $song->license_file);
                if (Storage::disk('public')->exists($oldLicensePath)) {
                    Storage::disk('public')->delete($oldLicensePath);
                }
            }

            $licenseFile = $request->file('license_file');
            $licenseFilename = 'license_' . $song->id . '.' . $licenseFile->getClientOriginalExtension();
            $licenseFilePath = $licenseFile->storeAs('songs/licenses', $licenseFilename, 'public');
            $licenseFilePath = 'storage/' . $licenseFilePath;
        }

        if ($request->hasFile('file_path')) {

            // Hapus file lama
            if ($song->file_path) {
                $oldAudioPath = str_replace('storage/', '', $song->file_path);
                if (Storage::disk('public')->exists($oldAudioPath)) {
                    Storage::disk('public')->delete($oldAudioPath);
                }
            }

            $audioFile = $request->file('file_path');
            $audioFilename = 'audio_' . $song->id . '.' . $audioFile->getClientOriginalExtension();
            $audioFilePath = $audioFile->storeAs('songs/audio', $audioFilename, 'public');
            $audioFilePath = 'storage/' . $audioFilePath;

        }

        $song->update([
            'title' => $request->title,
            'version' => $request->version ?? 'original',
            'description' => $request->description,
            'genre_id' => $request->genre_id,
            'album_id' => $request->album_id,
            'artist_id' => $request->artist_id,
            'cover_creator_id' => $request->cover_creator_id,
            'cover_version' => $request->cover_version,
            'license_type' => $request->license_type,
            'license_price' => $request->license_price,
            'license_file' => $licenseFilePath,
            'allow_cover_version' => $request->allow_cover_version,
            'allow_commercial_use' => $request->allow_commercial_use,
            'release_date' => $request->release_date,
            'cover_image' => $coverImagePaths,
            'file_path' => $audioFilePath,
            'duration' => $request->duration,
            'status' => $request->status,
        ]);

        $song->composers()->sync($request->composer_ids ?? []);

        activity('song')
            ->withProperties(['ip' => request()->ip()])
            ->log(Auth::user()->name . ' updated a song');

        return redirect()->route('admin.songs.index')->with('success', 'Song successfully updated.');
    }

    public function show(Request $request, $id)
    {
        $authUser = Auth::user();

        // Ambil data lagu lengkap dengan relasinya
        $song = Song::with(['album', 'artist', 'genre', 'coverCreator', 'composers', 'coverVersions..artist'])->findOrFail($id);
        $coverVersions = $song->coverVersions;

        activity('song')
            ->withProperties(['ip' => request()->ip()])
            ->log($authUser->name . ' visited show song form for song: ' . $song->title);

        return view('admin.songs.show', compact('song','coverVersions'));
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:activate,deactivate,delete',
            'song_ids' => 'required|array',
            'song_ids.*' => 'exists:songs,id',
        ]);

        if ($request->action === 'delete') {
            $songs = Song::whereIn('id', $request->song_ids)->get();

            foreach ($songs as $song) {
                // Delete cover images (lg, md, sm)
                if ($song->cover_image) {
                    $paths = explode(',', $song->cover_image);
                    foreach ($paths as $path) {
                        $relativePath = str_replace('storage/', '', $path);
                        if (Storage::disk('public')->exists($relativePath)) {
                            Storage::disk('public')->delete($relativePath);
                        }
                    }
                }

                // Delete license file
                if ($song->license_file) {
                    $relativePath = str_replace('storage/', '', $song->license_file);
                    if (Storage::disk('public')->exists($relativePath)) {
                        Storage::disk('public')->delete($relativePath);
                    }
                }

                // Delete audio file
                if ($song->file_path) {
                    $relativePath = str_replace('storage/', '', $song->file_path);
                    if (Storage::disk('public')->exists($relativePath)) {
                        Storage::disk('public')->delete($relativePath);
                    }
                }

                // Detach composer relationships
                $song->composers()->detach();

                // Delete song record
                $song->delete();

                // Log activity for each song
                activity('song')
                    ->withProperties(['ip' => request()->ip()])
                    ->log(Auth::user()->name . ' deleted song: ' . $song->title);
            }

            return response()->json([
                'success' => true,
                'message' => 'Selected songs have been deleted.'
            ]);
        }

        // Activate or Deactivate
        $status = $request->action === 'activate' ? 'Active' : 'Inactive';

        Song::whereIn('id', $request->song_ids)->update(['status' => $status]);

        activity('song')
            ->withProperties(['ip' => request()->ip()])
            ->log(Auth::user()->name . ' performed bulk ' . $request->action . ' on songs: ' . implode(', ', $request->song_ids));

        return response()->json([
            'success' => true,
            'message' => 'Selected songs have been ' . $request->action . 'd.'
        ]);
    }



    public function destroy(Song $song)
    {
        // Hapus cover image (bisa ada 3 ukuran: lg, md, sm)
        if ($song->cover_image) {
            $paths = explode(',', $song->cover_image);
            foreach ($paths as $path) {
                $relativePath = str_replace('storage/', '', $path);
                if (Storage::disk('public')->exists($relativePath)) {
                    Storage::disk('public')->delete($relativePath);
                }
            }
        }

        // Hapus license file
        if ($song->license_file) {
            $relativePath = str_replace('storage/', '', $song->license_file);
            if (Storage::disk('public')->exists($relativePath)) {
                Storage::disk('public')->delete($relativePath);
            }
        }

        // Hapus audio file
        if ($song->file_path) {
            $relativePath = str_replace('storage/', '', $song->file_path);
            if (Storage::disk('public')->exists($relativePath)) {
                Storage::disk('public')->delete($relativePath);
            }
        }

        // Hapus relasi composer (jika ada)
        $song->composers()->detach();

        // Hapus record lagu
        $song->delete();

        // Log aktivitas
        activity('song')
            ->withProperties(['ip' => request()->ip()])
            ->log(Auth::user()->name . ' deleted song: ' . $song->title);

        return redirect()->route('admin.songs.index')->with('success', 'Song successfully deleted.');
    }
}
