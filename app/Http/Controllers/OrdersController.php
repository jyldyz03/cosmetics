<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\CartItem;

class OrdersController extends Controller
{
    public function checkout()
    {
        // Ваш код для отображения формы оформления заказа
        return view('orders.checkout');
    }

    public function placeOrder(Request $request)
    {
        // Ваш код для обработки заказа
        // Создание заказа в базе данных и сохранение товаров из корзины в заказе
        $user = auth()->user();
        $cartItems = $user->cartItems;
        $total = $cartItems->sum('subtotal');

        $order = new Order([
            'user_id' => $user->id,
            'total' => $total,
        ]);

        $order->save();

        foreach ($cartItems as $cartItem) {
            $order->products()->attach($cartItem->product_id, ['quantity' => $cartItem->quantity]);
            $cartItem->delete();
        }

        // Дополнительная логика, такая как обработка платежа, отправка уведомлений и т. д.

        return redirect()->route('home')->with('success', 'Заказ успешно оформлен!');
    }
}
