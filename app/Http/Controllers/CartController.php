<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $cart = $user->cart;

        return view('cart.index', compact('cart'));
    }

    public function addProduct(Product $product)
    {
        $user = auth()->user();
        $cart = $user->cart;

        // Проверка наличия корзины пользователя
        if (!$cart) {
            // Если нет, создаем новую корзину
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->save();
        }

        // Проверка, что продукт не был добавлен ранее
        if (!$cart->products->contains($product->id)) {
            // Привязываем продукт к корзине
            $cart->products()->attach($product->id, ['quantity' => 1]);

            return redirect()->back()->with('success', 'Product added to cart.');
        }

        return redirect()->back()->with('warning', 'Product is already in the cart.');
    }

    public function removeProduct(Product $product)
    {
        $user = auth()->user();
        $cart = $user->cart;

        // Проверка, что продукт присутствует в корзине
        if ($cart->products->contains($product->id)) {
            // Удаляем продукт из корзины
            $cart->products()->detach($product->id);

            return redirect()->back()->with('success', 'Product removed from cart.');
        }

        return redirect()->back()->with('warning', 'Product not found in the cart.');
    }

    public function updateQuantity(Request $request, Product $product)
    {
        $user = auth()->user();
        $cart = $user->cart;

        // Проверка, что продукт присутствует в корзине
        if ($cart->products->contains($product->id)) {
            $quantity = $request->input('quantity', 1);

            // Проверка наличия положительного количества
            if ($quantity > 0) {
                // Обновляем количество продукта в корзине
                $cart->products()->updateExistingPivot($product->id, ['quantity' => $quantity]);

                return redirect()->back()->with('success', 'Cart updated.');
            }

            return redirect()->back()->with('error', 'Invalid quantity.');
        }

        return redirect()->back()->with('warning', 'Product not found in the cart.');
    }
}
