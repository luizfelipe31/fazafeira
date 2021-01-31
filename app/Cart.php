<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'product',
        'user',
        'quantity'
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product');
    }


}
