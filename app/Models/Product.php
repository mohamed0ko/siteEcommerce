<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'size',
        'imagepath',
        'quantity',
        'price',
        'discount_price',
        'status',
        'category_id',


    ];
    protected $table = 'products';
    protected $casts = [
        'size' => 'array',
        'imagepath' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'color_product');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_product');
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
