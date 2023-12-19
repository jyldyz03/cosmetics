<?php

// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'brand', 'stock_quantity', 'category_id', 'image_path',
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function favorites(): HasMany
    {
     return $this->hasMany(UserFavoriteProduct::class);
    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_favorite_products');
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class)->withPivot('quantity');
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('quantity', 'price');
    }
}
