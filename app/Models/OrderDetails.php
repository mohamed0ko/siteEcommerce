<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'size',
        'quantityCart',
        'price',
        'color',
        'imagepath',
        'order_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
