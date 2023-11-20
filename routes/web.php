<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

//Route::get('/', [ProductController::class, 'index'])->name('home');


Route::get('/', function () {
    return view('welcome');
});
// Маршруты для аутентификации и профиля
Route::middleware(['auth', 'verified'])->group(function () {
    // Маршрут для отображения дашборда
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Маршруты для профиля
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
   // Маршрут для отображения списка категорий
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
 // Маршрут для отображения продуктов в выбранной категории
Route::get('/categories/{categoryId}/products', [CategoryController::class, 'showProductsByCategory'])->name('category.products');
Route::resource('categories', CategoryController::class)->only(['index', 'show']);


// Маршруты для продуктов
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/create-products', [ProductController::class, 'createProducts']);


// Добавьте другие маршруты по необходимости
// Authentication Routes...
require __DIR__.'/auth.php';
