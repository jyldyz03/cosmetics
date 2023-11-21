<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('products.index', ['products' => $products]);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', ['product' => $product]);
    }

    public function createProducts()
    {
        $existingProductsCount = Product::count();

        // Проверяем, есть ли уже продукты в базе данных
        if ($existingProductsCount === 0) {
            $categoriesData = [
                ['name' => 'Помады', 'description' => 'Категория для помад'],
                ['name' => 'Крема', 'description' => 'Категория для кремов'],
                ['name' => 'Тени', 'description' => 'Категория для теней'],
            ];

            foreach ($categoriesData as $categoryData) {
                $category = Category::create($categoryData);

                $productsData = [
                    [
                        'name' => 'Помада Рубиновый Красный',
                        'description' => 'Лучшая помада для губ',
                        'price' => 15.99,
                        'brand' => 'Ruby Cosmetics',
                        'stock_quantity' => 100,
                        'image_path' => 'images/products/lipstick-Ruby-Red.jpg',
                        'category_id' => $category->id,
                    ],
                    [
                        'name' => 'Крем для лица Витамикс',
                        'description' => 'Увлажняющий крем для лица',
                        'price' => 24.99,
                        'brand' => 'Vitamix Beauty',
                        'stock_quantity' => 50,
                        'image_path' => 'images/products/cream_Vitamix.jpg',
                        'category_id' => $category->id,
                    ],
                    [
                        'name' => 'Тени для век Diamond Glitter',
                        'description' => 'Сияющие тени для век',
                        'price' => 12.50,
                        'brand' => 'Diamond Cosmetics',
                        'stock_quantity' => 75,
                        'image_path' => 'images/products/eyes-shadow-Diamond.jpg',
                        'category_id' => $category->id,
                    ],
                    [
                        'name' => 'Помада Вишневый Глянец',
                        'description' => 'Сочная помада для губ',
                        'price' => 18.99,
                        'brand' => 'Cherry Beauty',
                        'stock_quantity' => 80,
                        'image_path' => 'images/products/lipstick-Cherry-Gloss.jpg',
                        'category_id' => $category->id,
                    ],
                    [
                        'name' => 'Крем для рук Шелковые Сны',
                        'description' => 'Нежный крем для рук',
                        'price' => 14.99,
                        'brand' => 'Silk Dreams',
                        'stock_quantity' => 60,
                        'image_path' => 'images/products/hand-cream-Silk-Dreams.jpg',
                        'category_id' => $category->id,
                    ],
                    [
                        'name' => 'Тени для век Гламурная Ночь',
                        'description' => 'Тени для век на особый случай',
                        'price' => 16.75,
                        'brand' => 'Glam Night',
                        'stock_quantity' => 90,
                        'image_path' => 'images/products/eyes-shadow-Glam-Night.jpg',
                        'category_id' => $category->id,
                    ],
                ];

                // Проходим по каждому продукту и устанавливаем category_id
                foreach ($productsData as $productData) {
                    // Добавляем проверку, чтобы не создавать продукты с одинаковыми именами в разных категориях
                    $existingProduct = Product::where('name', $productData['name'])->first();
                    if (!$existingProduct) {
                        $product = Product::create($productData);
                        echo "Product {$product->name} created with category_id: {$product->category_id}\n";
                    }
                }
            }

            return "Косметические продукты созданы и сохранены в базе данных.";
        }

        return "Продукты уже существуют в базе данных.";
    }
}
