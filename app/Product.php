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
        'photo',
        'status',
    ];

    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand');
    }

}
