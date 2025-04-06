<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AdminGenreController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 15);

        $query = Genre::withCount('songs')
            ->addSelect([
                'albums_count' => Song::selectRaw('COUNT(DISTINCT album_id)')
                    ->whereColumn('genre_id', 'genres.id')
            ]);

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $genres = $query->latest()->paginate($perPage);

        return view('admin.genres.index', compact('genres'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon_color' => 'nullable|string|max:20',
            'status' => 'required|in:active,pending,inactive',
        ]);

        Genre::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'description' => $request->description,
            'icon_color' => $request->icon_color,
            'status' => $request->status,
        ]);

        activity('genre')
            ->withProperties(['ip' => request()->ip()])
            ->log(Auth::user()->name . ' created a genre');

        return redirect()->route('admin.genres.index')->with('success', 'Genre successfully added.');
    }

    public function edit(Genre $genre)
    {

    }

    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon_color' => 'nullable|string|max:20',
            'status' => 'required|in:active,pending,inactive',
        ]);

        $genre->update([
            'name' => $request->name,
            'description' => $request->description,
            'icon_color' => $request->icon_color,
            'status' => $request->status,
        ]);

        activity('genre')
            ->withProperties(['ip' => request()->ip()])
            ->log(Auth::user()->name . ' updated a genre');

        return redirect()->route('admin.genres.index')->with('success', 'Genre successfully updated.');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();

        activity('genre')
            ->withProperties(['ip' => request()->ip()])
            ->log(Auth::user()->name . ' deleted a genre');

        return redirect()->route('admin.genres.index')->with('success', 'Genre successfully deleted.');
    }
}
