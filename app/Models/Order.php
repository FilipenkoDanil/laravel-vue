<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'fio',
        'phone',
        'address',
        'sum',
        'new',
    ];

    public function products() {
        return $this->belongsToMany(Product::class)->withPivot('count', 'price');
    }
}
