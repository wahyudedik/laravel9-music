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
        'description',
        'lyrics',
        'genre_id',
        'album_id',
        'artist_id',
        'cover_creator_id',
        'cover_version',
        'license_status',
        'license_type',
        'license_price',
        'license_file',
        'allow_cover_version',
        'allow_commercial_use',
        'release_date',
        'play_count',
        'like_count',
        'cover_image',
        'file_path',
        'duration',
        'local_zones',
        'status',
        'created_by',
        'updated_by',
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
        return $this->belongsToMany(User::class, 'composer_song', 'song_id', 'user_id');
    }

    public function song()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function coverCreator()
    {
        return $this->belongsTo(User::class, 'cover_creator_id');
    }

    // Songs that are covering this song (i.e. children)
    public function coverVersions()
    {
        return $this->hasMany(Song::class, 'cover_song_id');
    }

    // The original song this is covering (i.e. parent)
    public function originalSong()
    {
        return $this->belongsTo(Song::class, 'cover_song_id');
    }

    // In Song.php
    public function contributors()
    {
        return $this->belongsToMany(User::class, 'song_contributor', 'song_id', 'user_id')
            ->withPivot('id') // include extra pivot fields if needed
            ->withTimestamps(); // only if you have created_at/updated_at
    }

    // In Song.php
    public function songContributors()
    {
        //$song->songContributors()->with('user')->get();
        return $this->hasMany(SongContributor::class, 'song_id');

    }

    public function licenses()
    {
        return $this->hasMany(SongLicense::class, 'song_id');

    }
}
