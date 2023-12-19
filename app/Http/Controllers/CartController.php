<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    public function checkout(Request $request)
    {
        $user = auth()->user();

        // Создаем новый заказ
        $order = new Order();
        $order->user_id = $user->id;
        $order->total_amount = $request->input('totalAmount');
        $order->save();

        // Получаем товары из корзины пользователя
        $cartItems = $user->cart->products;

        // Добавляем товары из корзины в заказ
        foreach ($cartItems as $cartItem) {
            $orderItem = new OrderItem([
                'product_id' => $cartItem->id,
                'quantity' => $cartItem->pivot->quantity,
                'price' => $cartItem->price,
            ]);
            $order->items()->save($orderItem);
        }

        // Очищаем корзину пользователя
        $user->cart->products()->detach();

        // Редиректим на страницу с подтверждением заказа или куда вам нужно
        return redirect()->route('checkout.success', ['order_id' => $order->id]);
    }

    public function index()
    {
        $user = auth()->user();

        // Проверяем, аутентифицирован ли пользователь
        if ($user) {
            // Используем метод firstOrCreate для создания или получения корзины пользователя
            $cart = Cart::firstOrCreate(['user_id' => $user->id]);

            // Загружаем связанные продукты
            $cart->load('products');

            return view('cart.index', compact('cart'));
        } else {
            // Действие в случае, если пользователь не аутентифицирован
            return redirect()->route('login')->with('warning', 'Please log in to view your cart.');
        }
    }

    public function addProduct(Product $product)
    {
        $user = auth()->user();

        // Получаем существующую корзину пользователя или создаем новую
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        // Используем метод toggle для упрощения добавления/удаления продукта
        $cart->products()->toggle($product->id);

        return redirect()->back()->with('success', 'Product updated in the cart.');
    }

    public function removeProduct(Product $product)
{
    $user = auth()->user();

    // Получаем существующую корзину пользователя или создаем новую
    $cart = Cart::firstOrCreate(['user_id' => $user->id]);

    // Используем метод detach для удаления продукта из корзины
    $cart->products()->detach($product->id);

    // Перезагружаем связанные продукты
    $cart->load('products');

    return redirect()->back()->with('success', 'Product removed from the cart.');
}


    public function updateQuantity(Request $request, Product $product)
{
    $user = auth()->user();

    // Получаем существующую корзину пользователя или создаем новую
    $cart = Cart::firstOrCreate(['user_id' => $user->id]);

    // Загружаем связанные продукты
    $cart->load('products');

    // Получаем продукт из корзины
    $cartProduct = $cart->products->find($product->id);

    if ($cartProduct) {
        // Обновляем количество продукта в корзине
        $quantity = $request->input('quantity', 1);

        // Обновляем количество напрямую через отношение
        $cartProduct->pivot->quantity = max(1, $quantity);
        $cartProduct->pivot->save();

        return redirect()->back()->with('success', 'Cart updated.');
    }

    return redirect()->back()->with('warning', 'Product not found in the cart.');
}

}
