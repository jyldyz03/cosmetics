<?php

// database/seeders/ProductSeeder.php

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Помада Рубиновый Красный',
                'description' => 'Лучшая помада для губ',
                'price' => 15.99,
                'brand' => 'Ruby Cosmetics',
                'stock_quantity' => 100,
                'image_path' => 'images/products/lipstick-Ruby-Red.jpg',
            ],
            [
                'name' => 'Крем для лица Витамикс',
                'description' => 'Увлажняющий крем для лица',
                'price' => 24.99,
                'brand' => 'Vitamix Beauty',
                'stock_quantity' => 50,
                'image_path' => 'images/products/cream_Vitamix.jpg',
            ],
            [
                'name' => 'Тени для век Diamond Glitter',
                'description' => 'Сияющие тени для век',
                'price' => 12.50,
                'brand' => 'Diamond Cosmetics',
                'stock_quantity' => 75,
                'image_path' => 'images/products/eyes-shadow-Diamond.jpg',
       ]);

        // Добавьте остальные продукты с соответствующими category_id
    }
}
