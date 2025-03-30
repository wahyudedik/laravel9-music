<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserProfileController extends Controller
{
    public function index()
    {
        $users = User::withCount('songs', 'covers', 'albums')->with('roles')->limit(10)->get();
        $users->load('verification');
        return view('admin.user-profiles.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(404);
        }

        $songs = Song::where('artist_id', $id)->get();

        $covers = Song::where('cover_creator_id', $id)->get();

        // $albums = Song::where('album_id', $id)->get();

        // $publishedSongs = Song::where('status', 'published', $id)->get();

        $albums = Album::where('artist_id', $id)->get(); // Perbaikan di sini

        $publishedSongs = Song::where('status', 'published')->where(function ($query) use ($id) {
            $query->where('artist_id', $id)
                ->orWhere('cover_creator_id', $id)
                ->orWhereIn('album_id', function ($subquery) use ($id) {
                    $subquery->select('id')
                        ->from('albums')
                        ->where('artist_id', $id);
                });
        })->get();

        return view('admin.user-profiles.show', compact('user', 'songs', 'covers', 'albums', 'publishedSongs'));
    }
}
