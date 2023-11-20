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
            ];

                // Проходим по каждому продукту и устанавливаем category_id
                foreach ($productsData as $productData) {
                    Product::create($productData);
                }
            }

            return "Косметические продукты созданы и сохранены в базе данных.";
        }

        return "Продукты уже существуют в базе данных.";
    }
}
