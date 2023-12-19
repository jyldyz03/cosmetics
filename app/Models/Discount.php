<?php

// app/Models/DiscountProduct.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discount_product';


    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }
    public function products()
{
    return $this->belongsToMany(Product::class, 'discount_product');
}
}
