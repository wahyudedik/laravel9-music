<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Models\Song;
use App\Models\Album;
use App\Models\Genre;
use App\Models\Transaction;
use App\Models\Stream;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class SongServices
{

    public function getAllSongs($search = null, $limit = 10)
    {
        $query = Song::select('id', 'title', 'artist_id')
            ->with('artist:id,name'); // Load artist name if available

        if ($search) {
            $query->where('title', 'LIKE', "%{$search}%");
        }

        return $query->limit($limit)->get()->map(function ($song) {
            return [
                'id' => $song->id,
                'title' => $song->title,
                'artist' => $song->artist ? $song->artist->name : 'Unknown Artist'
            ];
        });
    }

    public function getAllAlbums($search = null, $limit = 10)
    {
        $query = Album::select('id', 'title', 'artist_id')
            ->with('artist:id,name'); // Load artist name if available

        if ($search) {
            $query->where('title', 'LIKE', "%{$search}%");
        }

        return $query->limit($limit)->get()->map(function ($album) {
            return [
                'id' => $album->id,
                'title' => $album->title,
                'artist' => $album->artist ? $album->artist->name : 'Unknown Artist'
            ];
        });
    }

    public function getAllGenres($search = null, $limit = 10)
    {
        $query = Genre::select('id', 'name');

        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        }

        return $query->limit($limit)->get()->map(function ($genre) {
            return [
                'id' => $genre->id,
                'name' => $genre->name,
            ];
        });
    }
}
