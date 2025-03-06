<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable  = [
        'user_id',
        'product_id',
        'product_name',
        'size',
        'quantityCart',
        'price',
        'color',
        'imagepath',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
