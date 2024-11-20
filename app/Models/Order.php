<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total_amount',
        'shipping_address',
        'billing_address',
        'phone',
        'notes',
        'status'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2'
    ];

    // OrderItem ilişkisi
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // User ilişkisi
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}