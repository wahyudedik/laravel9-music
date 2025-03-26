<?php

namespace App\Models;

use App\Models\Song;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Claim extends Model
{
    use HasFactory;


    protected $table = 'claims';

    protected $fillable = [
        'id',
        'user_id',
        'song_id',
        'status',
        'notes',
        'document'
    ];

    protected $casts = [
        'id' => 'string',
        'user_id' => 'string',
        'song_id' => 'string',
        'status' => 'string',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function song(): BelongsTo
    {
        return $this->belongsTo(Song::class);
    }
}
