<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product; // Добавлен импорт класса Product
use App\Http\Controllers\Controller;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', ['categories' => $categories]);
    }
    public function showProductsByCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $products = $category->products; //
        dd($products->count());


        return view('categories.show', compact('category', 'products'));
    }
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show', ['category' => $category]);
    }

    public function createCategories()
    {
        $categoriesData = [
            ['name' => 'Помады', 'description' => 'Категория для помад'],
            ['name' => 'Крема', 'description' => 'Категория для кремов'],
            ['name' => 'Тени', 'description' => 'Категория для теней'],
        ];

        foreach ($categoriesData as $data) {
            Category::create($data);
        }

        return "Категории созданы и сохранены в базе данных.";
    }
}
