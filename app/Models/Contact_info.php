<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact_info extends Model
{
    protected $fillable = [
        'name_webSite',
        'email',
        'phone',
        'phone2',
        'support',
        'address',
        'contact__map'

    ];
}
