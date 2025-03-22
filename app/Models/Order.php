<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Order extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'orders'; // Define table name

    protected $fillable = [
        'id',
        'user_id',
        'status'
    ];

    /**
     * Relationship: Order belongs to a User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Order has many Transactions.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
