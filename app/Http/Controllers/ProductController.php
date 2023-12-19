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

    public function search(Request $request)
    {
        $query = $request->input('query');
        $encodedQuery = urlencode($query); // Кодирование строки запроса

        // Используйте LIKE для регистронезависимого поиска в MySQL
        $products = Product::where('name', 'LIKE', '%' . $query . '%')->get();

        return view('products.search', ['products' => $products, 'query' => $encodedQuery]);
    }

    public function addToFavorites(Product $product)
    {
        $user = auth()->user();

        // Check if the product is not already in the user's favorites
        if (!$user->favorites->contains($product->id)) {
            $user->favorites()->attach($product->id);
            return redirect()->back()->with('success', 'Product added to favorites!');
        } else {
            return redirect()->back()->with('info', 'Product is already in favorites.');
        }
    }

    public function removeFromFavorites(Product $product)
    {
        $user = auth()->user();

        // Detach the product from favorites
        $user->favorites()->detach($product->id);

        return redirect()->back()->with('success', 'Product removed from favorites!');
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
                ['name' => 'Тушь', 'description' => 'Категория для туши'],
            ];

            foreach ($categoriesData as $categoryData) {
                $category = Category::create($categoryData);

                $productsData = [
                    [
                        'name' => 'Помада Рубиновый Красный',
                        'description' => 'Лучшая помада для губ. Очень насыщенный цвет, стойкая формула.',
                        'price' => 15.99,
                        'brand' => 'Ruby Cosmetics',
                        'stock_quantity' => 100,
                        'image_path' => 'images/products/lipstick-Ruby-Red.jpg',
                    ],
                    [
                        'name' => 'Крем для лица Витамикс',
                        'description' => 'Увлажняющий крем для лица с витаминами A, C, E. Подходит для всех типов кожи.',
                        'price' => 24.99,
                        'brand' => 'Vitamix Beauty',
                        'stock_quantity' => 50,
                        'image_path' => 'images/products/cream_Vitamix.jpg',
                    ],
                    [
                        'name' => 'Тени для век Diamond Glitter',
                        'description' => 'Сияющие тени для век с мельчайшими блестками. Создайте великолепный макияж.',
                        'price' => 12.50,
                        'brand' => 'Diamond Cosmetics',
                        'stock_quantity' => 75,
                        'image_path' => 'images/products/eyes-shadow-Diamond.jpg',
                    ],
                    [
                        'name' => 'Помада Вишневый Глянец',
                        'description' => 'Сочная помада для губ. Идеально подходит для создания яркого образа.',
                        'price' => 18.99,
                        'brand' => 'Cherry Beauty',
                        'stock_quantity' => 80,
                        'image_path' => 'images/products/lipstick-Cherry-Gloss.jpg',
                        'category_id' => $category->id,
                    ],
                    [
                        'name' => 'Крем для рук Шелковые Сны',
                        'description' => 'Нежный крем для рук с приятным ароматом. Питает и увлажняет кожу.',
                        'price' => 14.99,
                        'brand' => 'Silk Dreams',
                        'stock_quantity' => 60,
                        'image_path' => 'images/products/hand-cream-Silk-Dreams.jpg',
                        'category_id' => $category->id,
                    ],
                    [
                        'name' => 'Тени для век Гламурная Ночь',
                        'description' => 'Тени для век на особый случай. Подчеркните свою загадочность.',
                        'price' => 16.75,
                        'brand' => 'Glam Night',
                        'stock_quantity' => 90,
                        'image_path' => 'images/products/eyes-shadow-Glam-Night.jpg',
                        'category_id' => $category->id,
                    ],

                    // Дополнительные продукты
                    [
                        'name' => 'Помада Лавандовый Сон',
                        'description' => 'Помада с утонченным лавандовым оттенком. Придает губам нежность и свежесть.',
                        'price' => 17.99,
                        'brand' => 'Lavender Bliss',
                        'stock_quantity' => 60,
                        'image_path' => 'images/products/lipstick-Lavender-Dream.jpg',
                        'category_id' => $category->id,
                    ],
                    [
                        'name' => 'Крем для лица Алоэ Вера',
                        'description' => 'Увлажняющий крем для лица с экстрактом алоэ вера. Смягчает и освежает кожу.',
                        'price' => 19.99,
                        'brand' => 'Aloe Elegance',
                        'stock_quantity' => 55,
                        'image_path' => 'images/products/face-cream-Aloe-Vera.jpg',
                        'category_id' => $category->id,
                    ],
                    [
                        'name' => 'Тени для век Магнолиевый Свет',
                        'description' => 'Тени для век с оттенками магнолии. Создайте свой неповторимый образ с этими утонченными тенями.',
                        'price' => 18.75,
                        'brand' => 'Magnolia Glow',
                        'stock_quantity' => 70,
                        'image_path' => 'images/products/eyes-shadow-Magnolia-Light.jpg',
                        'category_id' => $category->id,
                    ],

                    [
                        'name' => 'Помада Лесные Ягоды',
                        'description' => 'Помада с ароматом лесных ягод. Подчеркните свою индивидуальность с этим уникальным оттенком.',
                        'price' => 20.50,
                        'brand' => 'Forest Berries',
                        'stock_quantity' => 65,
                        'image_path' => 'images/products/lipstick-Forest-Berries.jpg',
                        'category_id' => $category->id,
                    ],
                    [
                        'name' => 'Крем для рук Шелковый Цветок',
                        'description' => 'Ароматический крем для рук с нежным запахом шелкового цветка. Придает рукам бархатистость.',
                        'price' => 16.99,
                        'brand' => 'Silk Flower',
                        'stock_quantity' => 75,
                        'image_path' => 'images/products/hand-cream-Silk-Flower.jpg',
                        'category_id' => $category->id,
                    ],
                    [
                        'name' => 'Тени для век Сапфировый Взгляд',
                        'description' => 'Тени для век с сапфировым оттенком. Создайте глубокий и загадочный макияж для особых моментов.',
                        'price' => 22.99,
                        'brand' => 'Sapphire View',
                        'stock_quantity' => 80,
                        'image_path' => 'images/products/eyes-shadow-Sapphire-Gaze.jpg',
                        'category_id' => $category->id,
                    ],
                    [
                        'name' => 'Помада Мятный Цвет',
                        'description' => 'Освежающая помада с мятным оттенком. Создайте натуральный и легкий образ.',
                        'price' => 16.50,
                        'brand' => 'Minty Beauty',
                        'stock_quantity' => 70,
                        'image_path' => 'images/products/lipstick-Mint-Color.jpg',
                    ],
                    [
                        'name' => 'Крем для лица Розовый Эликсир',
                        'description' => 'Крем с розовыми оттенками для максимального увлажнения кожи лица.',
                        'price' => 26.99,
                        'brand' => 'Rose Elixir',
                        'stock_quantity' => 45,
                        'image_path' => 'images/products/face-cream-Rose-Elixir.jpg',
                        'category_id' => $category->id,
                     ],
                    [
                        'name' => 'Тени для век Ванильное Облако',
                        'description' => 'Легкие тени для век с ванильным оттенком. Идеальны для повседневного макияжа.',
                        'price' => 14.75,
                        'brand' => 'Vanilla Cloud',
                        'stock_quantity' => 85,
                        'image_path' => 'images/products/eyes-shadow-Vanilla-Cloud.jpg',
                        'category_id' => $category->id,
                    ],
                       [
                          'name' => 'Тушь MaxVolume Lash Booster Mascara',
                          'description' => 'Объемная тушь с формулой, улучшающей рост ресниц.',
                          'price' => 19.99,
                          'brand' => 'BeautyEnhance',
                          'stock_quantity' => 30,
                         'image_path' => 'storage/images/products/maxvolume.jpg',

                       ],
                       [
                          'name' => 'Тушь Ultra Curling',
                          'description' => 'Водостойкая тушь для максимального изгиба ресниц.',
                          'price' => 24.99,
                          'brand' => 'GlamCurl',
                          'stock_quantity' => 25,
                          'image_path' => 'storage/images/products/ultracurl.jpg',
                       ],
                       [
                          'name' => 'Тушь Longlash',
                          'description' => 'Тушь с удлиняющим и  объемным эффектом.',
                          'price' => 22.50,
                          'brand' => 'EleganceBeauty',
                          'stock_quantity' => 40,
                          'image_path' => 'storage/images/products/longlash.jpg',
                       ],
                       [
                          'name' => 'Тушь Natural',
                          'description' => 'Тушь для природного и естественного вида ресниц.',
                          'price' => 17.99,
                          'brand' => 'PureGlow',
                          'stock_quantity' => 35,
                          'image_path' => 'storage/images/products/naturallook.jpg',

                       ],
                       [
                          'name' => 'Тушь Dramatic',
                          'description' => 'Драматическая тушь для максимального объема.',
                          'price' => 21.75,
                          'brand' => 'BoldStyle',
                          'stock_quantity' => 28,
                          'image_path' => 'storage/images/products/dramaticvolume.jpg',
                       ],
                  ];
                  $discount1 = Discount::find(1); // Предположим, что у вас есть скидка с ID 1
                  $discount2 = Discount::find(2); // Предположим, что у вас есть скидка с ID 2

                  foreach ($productsData as $productData) {
                     $productData['category_id'] = $category->id;
                    // Создание продукта
                     $product = Product::create($productData);
                    // Связывание продукта с скидками
                     $product->discounts()->attach([$discount1->id, $discount2->id]);
                     echo "Product {$product->name} created with category_id: {$product->category_id}\n";
                 }
             }
          return "Косметические продукты созданы и сохранены в базе данных.";
      }
        return "Продукты уже существуют в базе данных.";
    }
}
