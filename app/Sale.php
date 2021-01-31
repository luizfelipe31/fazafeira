<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'product',
        'user',
        'payment',
        'price'
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user');
    }

    public function productBrand()
    {
        return (new product());
    }
}
