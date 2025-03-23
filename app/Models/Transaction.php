<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Transaction extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'transactions'; // Define table name

    protected $fillable = [
        'id',
        'user_id',
        'order_id',
        'type',
        'amount',
        'status'
    ];

    /**
     * Relationship: Transaction belongs to a User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Transaction belongs to an Order.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
