<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class UserSocialMedia extends Model
{
    use HasFactory;

    protected $table = 'user_social_media';

    protected $fillable = [
        'id',
        'user_id',
        'platform',
        'url',
    ];

    protected $keyType = 'string'; // Menentukan tipe kunci utama adalah string

    public $incrementing = false; // Menentukan bahwa kunci utama tidak bertambah otomatis

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
