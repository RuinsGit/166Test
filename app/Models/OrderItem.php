<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price'
    ];

    // Order ilişkisi
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Product ilişkisi
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}