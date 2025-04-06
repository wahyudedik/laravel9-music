<?php

namespace App\Models;

use App\Models\Album;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\Stream;

class Song extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'id',
        'title',
        'version',
        'genre',
        'album_id',
        'composer_id',
        'artist_id',
        'cover_creator_id',
        'cover_version',
        'license_status',
        'release_date',
        'play_count',
        'like_count',
        'cover_image',
        'file_path',
        'duration',
        'status',
    ];

    protected $casts = [
        'release_date' => 'date',
    ];

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }

    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id');
    }

    public function composers()
    {
        return $this->belongsToMany(User::class, 'composer_song');
    }

    public function song()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }

    public function coverCreator()
    {
        return $this->belongsTo(User::class, 'cover_creator_id');
    }
}
