<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Song;
use App\Models\Stream;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function dashboard(Request $request)
    {
        $query = $request->input('q');
        $results = [];
        $allSongs = Song::with('artist')->get();

        if ($query) {
            $results = Song::where('title', 'like', "%$query%")
                ->orWhereHas('artist', function ($q) use ($query) {
                    $q->where('name', 'like', "%$query%");
                })
                ->with('artist')
                ->get();
        }

        $popularSongs = Song::with('artist')
            ->select('songs.*', DB::raw('COUNT(streams.song_id) as stream_count'))
            ->leftJoin('streams', 'songs.id', '=', 'streams.song_id')
            ->groupBy('songs.id')
            ->orderByDesc('stream_count')
            ->limit(5)
            ->get();

        // Artis Populer (berdasarkan jumlah stream lagu mereka)
        $popularArtists = User::select('users.*', DB::raw('COUNT(streams.song_id) as stream_count'))
            ->leftJoin('songs', 'users.id', '=', 'songs.artist_id')
            ->leftJoin('streams', 'songs.id', '=', 'streams.song_id')
            ->whereNotNull('songs.artist_id')
            ->groupBy('users.id')
            ->orderByDesc('stream_count')
            ->limit(5)
            ->get();

        // Pencipta Populer (berdasarkan jumlah stream lagu mereka)
        $popularComposers = User::select('users.*', DB::raw('COUNT(streams.song_id) as stream_count'))
            ->leftJoin('songs', 'users.id', '=', 'songs.composer_id')
            ->leftJoin('streams', 'songs.id', '=', 'streams.song_id')
            ->whereNotNull('songs.composer_id')
            ->groupBy('users.id')
            ->orderByDesc('stream_count')
            ->limit(5)
            ->get();

        // Cover Creator Populer (berdasarkan jumlah stream lagu yang menggunakan cover mereka)
        $popularCoverCreators = User::select('users.*', DB::raw('COUNT(streams.song_id) as stream_count'))
            ->leftJoin('songs', 'users.id', '=', 'songs.cover_creator_id')
            ->leftJoin('streams', 'songs.id', '=', 'streams.song_id')
            ->whereNotNull('songs.cover_creator_id')
            ->groupBy('users.id')
            ->orderByDesc('stream_count')
            ->limit(5)
            ->get();

        return view('users.dashboard', [
            'results' => $results,
            'query' => $query,
            'allSongs' => $allSongs,
            'popularSongs' => $popularSongs,
            'popularArtists' => $popularArtists,
            'popularComposers' => $popularComposers,
            'popularCoverCreators' => $popularCoverCreators,
        ]);
    }

    public function play($id)
    {
        $song = Song::find($id);

        if (!$song || !$song->file_path) {
            return response()->json(['error' => 'Lagu tidak ditemukan atau file tidak tersedia.'], 404);
        }

        $url = Storage::url($song->file_path);

        return response()->json(['url' => $url]);
    }
}
