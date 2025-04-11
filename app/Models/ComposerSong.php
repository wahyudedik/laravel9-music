<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ComposerSong extends Pivot
{
    protected $table = 'composer_song';
    public $incrementing = false;
    protected $fillable = ['song_id', 'user_id'];
}
