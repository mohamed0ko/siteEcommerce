<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'firstname',
        'lastname',
        'country',
        'addrres',
        'apartment',
        'city',
        'postcode',
        'phone',
        'email',
        'note',
        'user_id',
    ];


    public function orderDetails() // Use camelCase
    {
        return $this->hasMany(OrderDetails::class); // Singular relationship name
    }
}
