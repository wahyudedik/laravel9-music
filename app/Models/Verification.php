<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Verification extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'verifications';

    protected $fillable = [
        'id',
        'user_id',
        'type',
        'document_ktp',
        'document_npwp',
        'status',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
