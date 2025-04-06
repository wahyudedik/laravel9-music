<?php

namespace App\Models;

use App\Models\Song;
use App\Models\Album;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Genre extends Model
{
    use HasFactory;

    protected $table = 'genres';

    protected $fillable = [
        'id',
        'name',
        'description',
        'icon_color',
        'status',
    ];

    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'description' => 'string',
        'icon_color' => 'string',
        'status' => 'string',
    ];

    /**
     * Relasi: Genre memiliki banyak lagu
     */
    public function songs(): HasMany
    {
        return $this->hasMany(Song::class);
    }

    public function albums()
    {
        return $this->hasManyThrough(Album::class, Song::class, 'genre_id', 'id', 'id', 'album_id')
            ->distinct();
    }
}
