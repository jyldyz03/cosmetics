<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();

        $orders = Order::where('user_id', '=', $user_id)->get();

        // $orders = Order::all();

        return view('orders.index', compact('orders'));
    }
    public function cancel($id)
{
    $order = Order::findOrFail($id);

    // Добавьте здесь код для отмены заказа, например, пометьте его как отмененный в базе данных

    return redirect()->back()->with('success', 'Заказ успешно отменен');
}

}