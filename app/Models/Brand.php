<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name'

    ];
    public function Product()
    {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }
}
