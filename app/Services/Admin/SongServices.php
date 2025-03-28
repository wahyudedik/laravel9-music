<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Models\Song;
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
}
