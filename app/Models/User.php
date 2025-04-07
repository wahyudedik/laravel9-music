<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Album;
use App\Models\Song;
use App\Models\Verification;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Symfony\Component\HttpFoundation\File\Stream;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable, HasUuids;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'reset_token',
        'email_verified_at',
        'email_verification_sent_at',
        'email_verification_token',
        'password',
        'phone',
        'city',
        'region',
        'country',
        'profile_picture',
        'followers',
        'following',
        'last_login',
        'ip_address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function recentlySentVerificationEmail()
    {
        return $this->email_verification_sent_at
            && now()->diffInMinutes(Carbon::parse($this->email_verification_sent_at)) < 5;
    }

    public function songs()
    {
        return $this->hasMany(Song::class, 'artist_id');
    }

    public function covers()
    {
        return $this->hasMany(Song::class, 'cover_creator_id');
    }
    public function albums()
    {
        return $this->hasMany(Album::class, 'artist_id');
    }

    public function composedSongs()
    {
        return $this->belongsToMany(Song::class, 'composer_song');
    }

    public function verification()
    {
        return $this->hasOne(Verification::class, 'user_id');
    }
}
