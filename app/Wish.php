<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wish extends Model
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
    
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user');
    }
}
