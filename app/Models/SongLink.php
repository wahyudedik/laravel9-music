<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SongLink extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'songs_links';

    protected $fillable = [
        'id',
        'song_id',
        'platform',
        'link',
        'created_at',
        'updated_at',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function song()
    {
        return $this->belongsTo(Song::class, 'song_id');
    }
}
