<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_code',
        'order_date',
        'order_amount',
        'order_change',
        'order_status',
    ];

    protected $casts = [
        'order_date'   => 'datetime',
        'order_amount' => 'decimal:2',
        'order_change' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class)->with('product');
    }
}
