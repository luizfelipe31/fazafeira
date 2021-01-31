<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'price',
        'stock',
        'user',
        'photo',
        'status',
    ];

    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand');
    }
    
    public function user_name()
    {
        return $this->hasOne(User::class, 'id', 'user');
    }

}
