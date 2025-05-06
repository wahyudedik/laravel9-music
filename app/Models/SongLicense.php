<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SongLicense extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'song_licences';

    protected $fillable = [
        'id',
        'song_id',
        'license_type',
        'amount_type',
        'local_amount',
        'global_amount',
        'licence_file',
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
}
