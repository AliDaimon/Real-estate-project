<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'title',
        'price',
        'location',
        'type',
        'listing_type',
        'rooms',
        'bathrooms',
        'size',
        'description',
        'contact_phone',
        'images',
        'status',
        'user_id'
    ];

    protected $casts = [
        'images' => 'array',
        'price' => 'decimal:2'
    ];
}
