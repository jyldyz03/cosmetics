<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CartController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard and profile routes
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Categories and products routes
    Route::resource('categories', CategoryController::class)->only(['index', 'show']);
    Route::get('/categories/{categoryId}/products', [CategoryController::class, 'showProductsByCategory'])->name('category.products');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/create-products', [ProductController::class, 'createProducts']);

    // Favorites routes
    Route::post('/products/{product}/add-to-favorites', [ProductController::class, 'addToFavorites'])->name('products.addToFavorites');
    Route::post('/products/{product}/remove-from-favorites', [ProductController::class, 'removeFromFavorites'])->name('products.removeFromFavorites');

    // Cart routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'addProduct'])->name('cart.add');
    Route::post('/cart/remove/{product}', [CartController::class, 'removeProduct'])->name('cart.remove');
    Route::post('/cart/update/{product}', [CartController::class, 'updateQuantity'])->name('cart.update');

    // Favorites and order routes
    Route::get('/favorites', [FavoritesController::class, 'index'])->name('favorites');
    Route::get('/orders/checkout', [OrdersController::class, 'checkout'])->name('orders.checkout');
    Route::post('/orders/place-order', [OrdersController::class, 'placeOrder'])->name('orders.placeOrder');
});

// Search route outside the middleware group
Route::get('/search/products', [ProductController::class, 'search'])->name('products.search');

// Authentication routes
require __DIR__.'/auth.php';
