<?php
// database/seeders/ProductSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $categoriesData = [
            ['id' => 1, 'name' => 'Помады', 'description' => 'Категория для помад'],
            ['id' => 2, 'name' => 'Крема', 'description' => 'Категория для кремов'],
            ['id' => 3, 'name' => 'Тени', 'description' => 'Категория для теней'],
            ['id' => 4, 'name' => 'Тушь', 'description' => 'Категория для туши'],
        ];

        foreach ($categoriesData as $categoryData) {
            $category = Category::updateOrCreate(['id' => $categoryData['id']], $categoryData);

            $productsData = [];

                if ($categoryData['id'] === 1) {
                    $productsData = [
                        [
                            'name' => 'Помада Рубиновый Красный',
                            'description' => 'Лучшая помада для губ. Очень насыщенный цвет, стойкая формула.',
                            'price' => 15.99,
                            'brand' => 'Ruby Cosmetics',
                            'stock_quantity' => 100,
                            'image_path' => 'images/products/lipstick-Ruby-Red.jpg',
                        ],
                        // Добавьте другие продукты для категории "Помады"
                        [
                            'name' => 'Помада Вишневый Глянец',
                            'description' => 'Сочная помада для губ. Идеально подходит для создания яркого образа.',
                            'price' => 18.99,
                            'brand' => 'Cherry Beauty',
                            'stock_quantity' => 80,
                            'image_path' => 'images/products/lipstick-Cherry-Gloss.jpg',
                        ],
                        [
                            'name' => 'Помада Лавандовый Сон',
                            'description' => 'Помада с утонченным лавандовым оттенком. Придает губам нежность и свежесть.',
                            'price' => 17.99,
                            'brand' => 'Lavender Bliss',
                            'stock_quantity' => 60,
                            'image_path' => 'images/products/lipstick-Lavender-Dream.jpg',
                        ],
                        [
                            'name' => 'Помада Лесные Ягоды',
                            'description' => 'Помада с ароматом лесных ягод. Подчеркните свою индивидуальность с этим уникальным оттенком.',
                            'price' => 20.50,
                            'brand' => 'Forest Berries',
                            'stock_quantity' => 65,
                            'image_path' => 'images/products/lipstick-Forest-Berries.jpg',
                        ],
                        [
                            'name' => 'Помада Мятный Цвет',
                            'description' => 'Освежающая помада с мятным оттенком. Создайте натуральный и легкий образ.',
                            'price' => 16.50,
                            'brand' => 'Minty Beauty',
                            'stock_quantity' => 70,
                            'image_path' => 'images/products/lipstick-Mint-Color.jpg',
                        ],
                    ];
                } elseif ($categoryData['id'] === 2) {
                    $productsData = [
                        [
                            'name' => 'Крем для лица Витамикс',
                            'description' => 'Увлажняющий крем для лица с витаминами A, C, E. Подходит для всех типов кожи.',
                            'price' => 24.99,
                            'brand' => 'Vitamix Beauty',
                            'stock_quantity' => 50,
                            'image_path' => 'images/products/cream_Vitamix.jpg',
                        ],
                        // Добавьте другие продукты для категории "Крема"
                        [
                            'name' => 'Крем для рук Шелковые Сны',
                            'description' => 'Нежный крем для рук с приятным ароматом. Питает и увлажняет кожу.',
                            'price' => 14.99,
                            'brand' => 'Silk Dreams',
                            'stock_quantity' => 60,
                            'image_path' => 'images/products/hand-cream-Silk-Dreams.jpg',
                        ],
                        [
                            'name' => 'Крем для лица Алоэ Вера',
                            'description' => 'Увлажняющий крем для лица с экстрактом алоэ вера. Смягчает и освежает кожу.',
                            'price' => 19.99,
                            'brand' => 'Aloe Elegance',
                            'stock_quantity' => 55,
                            'image_path' => 'images/products/face-cream-Aloe-Vera.jpg',
                        ],
                        [
                            'name' => 'Крем для рук Шелковый Цветок',
                            'description' => 'Ароматический крем для рук с нежным запахом шелкового цветка. Придает рукам бархатистость.',
                            'price' => 16.99,
                            'brand' => 'Silk Flower',
                            'stock_quantity' => 75,
                            'image_path' => 'images/products/hand-cream-Silk-Flower.jpg',
                        ],
                        [
                            'name' => 'Крем для лица Розовый Эликсир',
                            'description' => 'Крем с розовыми оттенками для максимального увлажнения кожи лица.',
                            'price' => 26.99,
                            'brand' => 'Rose Elixir',
                            'stock_quantity' => 45,
                            'image_path' => 'images/products/face-cream-Rose-Elixir.jpg',
                        ],
                    ];
                } elseif ($categoryData['id'] === 3) {
                    $productsData = [
                        [
                            'name' => 'Тени для век Diamond Glitter',
                            'description' => 'Сияющие тени для век с мельчайшими блестками. Создайте великолепный макияж.',
                            'price' => 12.50,
                            'brand' => 'Diamond Cosmetics',
                            'stock_quantity' => 75,
                            'image_path' => 'images/products/eyes-shadow-Diamond.jpg',
                        ],
                        // Добавьте другие продукты для категории "Тени"
                        [
                            'name' => 'Тени для век Гламурная Ночь',
                            'description' => 'Тени для век на особый случай. Подчеркните свою загадочность.',
                            'price' => 16.75,
                            'brand' => 'Glam Night',
                            'stock_quantity' => 90,
                            'image_path' => 'images/products/eyes-shadow-Glam-Night.jpg',
                        ],
                        [
                            'name' => 'Тени для век Магнолиевый Свет',
                            'description' => 'Тени для век с оттенками магнолии. Создайте свой неповторимый образ с этими утонченными тенями.',
                            'price' => 18.75,
                            'brand' => 'Magnolia Glow',
                            'stock_quantity' => 70,
                            'image_path' => 'images/products/eyes-shadow-Magnolia-Light.jpg',
                        ],
                        [
                            'name' => 'Тени для век Сапфировый Взгляд',
                            'description' => 'Тени для век с сапфировым оттенком. Создайте глубокий и загадочный макияж для особых моментов.',
                            'price' => 22.99,
                            'brand' => 'Sapphire View',
                            'stock_quantity' => 80,
                            'image_path' => 'images/products/eyes-shadow-Sapphire-Gaze.jpg',
                        ],
                        [
                            'name' => 'Тени для век Ванильное Облако',
                            'description' => 'Легкие тени для век с ванильным оттенком. Идеальны для повседневного макияжа.',
                            'price' => 14.75,
                            'brand' => 'Vanilla Cloud',
                            'stock_quantity' => 85,
                            'image_path' => 'images/products/eyes-shadow-Vanilla-Cloud.jpg',
                             ],
                    ];
                } elseif ($categoryData['id'] === 4) {
                    $productsData = [
                       [
                          'name' => 'Тушь MaxVolume Lash Booster Mascara',
                          'description' => 'Объемная тушь с формулой, улучшающей рост ресниц.',
                          'price' => 19.99,
                          'brand' => 'BeautyEnhance',
                          'stock_quantity' => 30,
                         'image_path' => 'images/products/maxvolume.jpg',

                       ],
                       [
                          'name' => 'Тушь Ultra Curling Waterproof Mascara',
                          'description' => 'Водостойкая тушь для максимального изгиба ресниц.',
                          'price' => 24.99,
                          'brand' => 'GlamCurl',
                          'stock_quantity' => 25,
                          'image_path' => 'images/products/ultracurl.jpg',
                       ],
                       [
                          'name' => 'Тушь Longlash Volumizing Mascara',
                          'description' => 'Тушь с удлиняющим и  объемным эффектом.',
                          'price' => 22.50,
                          'brand' => 'EleganceBeauty',
                          'stock_quantity' => 40,
                          'image_path' => 'images/products/longlash.jpg',
                       ],
                       [
                          'name' => 'Тушь Natural Look Mascara',
                          'description' => 'Тушь для природного и естественного вида ресниц.',
                          'price' => 17.99,
                          'brand' => 'PureGlow',
                          'stock_quantity' => 35,
                          'image_path' => 'images/products/naturallook.jpg',

                       ],
                       [
                          'name' => 'Тушь Dramatic Volume Mascara',
                          'description' => 'Драматическая тушь для максимального объема.',
                          'price' => 21.75,
                          'brand' => 'BoldStyle',
                          'stock_quantity' => 28,
                          'image_path' => 'images/products/dramaticvolume.jpg',
                       ],
                  ];

                }

                foreach ($productsData as $productData) {
                    // Присваиваем ID текущей категории продукту
                    $productData['category_id'] = $category->id;

                    // Создаем продукт
                    $product = Product::create($productData);

                    // Выводим сообщение о создании продукта
                 echo "Продукт {$product->name} создан с category_id: {$product->category_id}\n";
            }
        }

        return "Косметические продукты созданы и сохранены в базе данных.";
    }
}
