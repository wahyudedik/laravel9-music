<?php

namespace App\Models;

use App\Models\Song;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'artist_id',
        'title',
        'cover_image',
        'release_date',
    ];

    protected $casts = [
        'release_date' => 'date',
    ];

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }

    public function songs()
    {
        return $this->hasMany(Song::class, 'album_id');
    }
}
