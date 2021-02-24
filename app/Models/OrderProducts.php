<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'count',
        'price'
    ];

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }
}
