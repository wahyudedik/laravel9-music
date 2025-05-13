<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Genre;
use App\Models\Song;
use App\Models\ComposerSong;
use App\Models\User;
use App\Models\SongContributor;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{
    public function welcome(Request $request)
    {

        $perPageSong = $request->input('perPage', 15);
        $query = Song::with([
            'album',
            'genre',
            'licenses' => function ($query) {
                $query->orderBy('license_type', 'asc');
            },
            'songContributors.user'
        ]);
        $songs = $query->latest()->paginate($perPageSong)->appends($request->only('search', 'status', 'perPage'));

        $perPageArtist = $request->input('perPageArtist', 15);
        $artists = User::role('Artist')
            ->paginate($perPageArtist);


        return view('welcome', compact('songs','artists',));
    }
}
