<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AuthLoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\SupportTicketController;



Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/password/update', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.reset');
    Route::delete('/profile/delete', [ProfileController::class, 'delete'])->name('profile.delete');
});

Route::get('/email/verify/{id}/{hash}', function () {
    return view('auth.verify-email');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function () {
    // Controller responsible for sending email verification notification
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

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

// Checkout routes
Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout');
Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
Route::get('/checkout/success', [CheckoutController::class, 'checkoutSuccess'])->name('checkout.success');

// Payment routes
Route::get('/payment/online', [PaymentController::class, 'showOnlinePayment'])->name('payment.online');
Route::post('/payment/process-online', [PaymentController::class, 'processOnlinePayment'])->name('payment.processOnlinePayment');
Route::get('/payment/online/success', [PaymentController::class, 'onlinePaymentSuccess'])->name('payment.online.success');

Route::get('/login', [AuthLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthLoginController::class, 'login']);

// Search route outside the middleware group
Route::get('/search/products', [ProductController::class, 'search'])->name('products.search');
Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/clients/{id}', [ClientController::class, 'show'])->name('clients.show');
Route::get('/clients/{id}/orders', [ClientController::class, 'showOrders'])->name('clients.orders');
Route::patch('/orders/{id}/accept', [ClientController::class, 'accept'])->name('orders.accept');
Route::get('/confirmation/{order}', [ConfirmationController::class, 'showConfirmation'])->name('confirmation.show');

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/edit/{user}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/update/{user}', [AdminController::class, 'update'])->name('admin.update');
    Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/store', [AdminController::class, 'store'])->name('admin.store');
    Route::delete('/destroy/{user}', [AdminController::class, 'destroy'])->name('admin.destroy');
});


Route::get('/courier', [CourierController::class, 'index'])->name('courier.index'); // Маршрут для личного кабинета курьера
Route::patch('/courier/updateProfile', [CourierController::class, 'updateProfile'])->name('courier.updateProfile');
Route::patch('/courier/complete-order/{order}', [CourierController::class, 'completeOrder'])->name('courier.completeOrder');


Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');


Route::get('/support', [SupportTicketController::class, 'index'])->name('support.index');
Route::get('/support/create', [SupportTicketController::class, 'create'])->name('support.create');
Route::post('/support/store', [SupportTicketController::class, 'store'])->name('support.store');
Route::get('/support/{ticket}', [SupportTicketController::class, 'show'])->name('support.show');
Route::put('/support/{ticket}/close', [SupportTicketController::class, 'closeTicket'])->name('support.close');

