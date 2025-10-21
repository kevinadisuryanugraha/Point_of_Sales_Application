<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';

    protected $fillable = [
        'order_id',
        'product_id',
        'qty',
        'price',
        'subtotal',
    ];

    protected $casts = [
        'qty'            => 'integer',
        'price'    => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    protected $with = ['product'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getCalculatedSubtotalAttribute()
    {
        return $this->qty * $this->price;
    }
}
