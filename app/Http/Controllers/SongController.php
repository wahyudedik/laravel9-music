<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\SongContributor;
use App\Models\SongLink;

class SongController extends Controller
{
    public function play($id)
    {
        $song = Song::find($id);

        if (!$song || !$song->file_path) {
            abort(404, 'Lagu tidak ditemukan atau file tidak tersedia.');
        }

        $filePath = public_path($song->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'File lagu tidak ditemukan.');
        }

        return response()->file($filePath, ['Content-Type' => 'audio/mpeg']);
    }

    public function update(Request $request, $id)
    {
        $song = Song::find($id);

        if (!$song) {
            abort(404);
        }

        $request->validate([
            'title' => 'required|string',
            'genre' => 'required|string',
            'album_id' => 'nullable|exists:albums,id',
            'file_path' => 'nullable|file|mimes:mp3',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'release_date' => 'required|date',
            'description' => 'nullable|string',
            'lyrics' => 'nullable|string',
            'status' => 'required|in:draft,published,scheduled',
        ]);

        $song->title = $request->title;
        $song->genre = $request->genre;
        $song->album_id = $request->album_id;
        $song->release_date = $request->release_date;
        $song->description = $request->description;
        $song->lyrics = $request->lyrics;
        $song->status = $request->status;

        // Logika untuk menangani upload file dan gambar
        if ($request->hasFile('file_path')) {
            // ...
        }

        if ($request->hasFile('cover_image')) {
            // ...
        }

        $song->save();

        return redirect()->route('admin.user-profiles.show', $id)->with('success', 'Lagu berhasil diperbarui.');
    }

    public function playSong(Request $request, $id)
    {

        $authUser = Auth::user();

        // Ambil data lagu lengkap dengan relasinya
        $song = Song::with([
            'album',
            'genre',
            'links',
            'licenses' => function ($query) {
                $query->orderBy('license_type', 'asc');
            },
            'songContributors.user'
        ])->findOrFail($id);

        $coverVersions = $song->coverVersions;
        $artist = SongContributor::with(['user'])->where('song_id', $song->id)
            ->where('role', 'Artist')->first();
        $artistName = '';
        if ($artist) {
            $artistName = $artist->user->name;
        }

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
        $artist = [];
        $album = [];


        activity('song')
            ->withProperties(['ip' => request()->ip()])
            ->log($authUser->name . ' visited play song ' . $song->title);


        return view('play-song-v1-1', compact('id', 'song', 'genre', 'artist', 'album'));
    }

    public function showSong(Request $request, $id)
    {
        $authUser = Auth::user();

        $song = Song::with([
            'album',
            'genre',
            'links',
            'licenses' => fn($q) => $q->orderBy('license_type', 'asc'),
            'songContributors.user'
        ])->findOrFail($id);

        $composerName = $song->songContributors
            ->where('role', 'Composer')
            ->pluck('user.name')
            ->filter()
            ->implode(', ') ?: '-';

        $artistName = $song->songContributors
            ->where('role', 'Artist')
            ->pluck('user.name')
            ->filter()
            ->implode(', ') ?: 'No Artist';

        if ($authUser) {
            activity('song')
                ->withProperties(['ip' => request()->ip()])
                ->log($authUser->name . ' visited play song ' . $song->title);
        }

        $youtubeLink = $song->links
        ->where('platform', 'YouTube')
        ->pluck('link')
        ->first();
        $embedUrl = $youtubeLink ? convert_youtubev2($youtubeLink) : null;

        return response()->json([
            'status' => 'success',
            'message' => 'Show song success',
            'data' => [
                'id' => $id,
                'song' => $song,
                'genre' => $song->genre,
                'album' => $song->album,
                'artistName' => $artistName,
                'composerName' => $composerName,
                'embedUrl' => $embedUrl,
            ],
        ]);
    }
}
