<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function show()
    {
        return view('checkout.show');
    }

    public function processCheckout(Request $request)
    {
        // Retrieve cart items from the session
        $cartItems = session('cart', []);

        // Создайте заказ
        $order = Order::create([
            'user_id' => auth()->id(),
            'comment' => $request->input('comment'),
            'payment_method' => $request->input('payment_method'),
        ]);

        // Добавьте продукты к заказу
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem['product_id'],
                'quantity' => $cartItem['quantity'],
                'price' => $cartItem['product']->price,
            ]);
        }

        // Clear the cart after checkout
        session(['cart' => []]);

        return view('orders.checkout-success');
    }

    public function checkout($totalAmount = 0, $paymentMethod = 'cash')
    {
        return view('checkout.show', compact('totalAmount', 'paymentMethod'));
    }

    public function processOnlinePayment(Request $request)
    {
        // Добавьте здесь логику обработки онлайн-оплаты
        // Например, взаимодействие с платежным шлюзом и т.д.

        // Создайте заказ
        $order = Order::create([
            'user_id' => auth()->id(),
            'comment' => $request->input('comment'),
            'payment_method' => 'online',
        ]);

        // Добавьте продукты к заказу (аналогично методу processCheckout)

        // Очистите корзину после успешной онлайн-оплаты
        session(['cart' => []]);

        return view('payment.online-success');
    }
}
