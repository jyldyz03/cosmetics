<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courier;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class CourierController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $role = DB::table('users')
            ->where('id', '=', $userId)
            ->select('role')
            ->first();

        if ($role->role == 'courier') {
            $courier = Courier::where('user_id', $userId)->first();

            if ($courier) {
                $orders = Order::all(); // Изменено на получение всех заказов
                return view('courier.index', compact('orders', 'courier'));
            } else {
                $orders = [];
                return view('courier.index', compact('orders', 'courier'));
            }
        }

        return redirect()->route('products.index');
    }

    public function updateProfile(Request $request)
    {
        $userId = auth()->id();
        $role = DB::table('users')->where('id', $userId)->select('role')->first();

        if ($role->role == 'courier') {
            $courier = Courier::where('user_id', $userId)->first();

            if ($courier) {
                // Используйте fill() и save() для обновления профиля
                $courier->fill($request->all());
                $courier->save();

                return redirect()->route('courier.index')->with('success', 'Профиль успешно обновлен!');
            } else {
                // Если курьер не найден, верните ошибку или выполните другие действия
            }
        }

        return redirect()->route('products.index');
    }
    public function completeOrder(Request $request, $orderId)
{
    $order = Order::find($orderId);

    // Дополнительные проверки и логика завершения заказа

    $order->completed = true;
    $order->save();

    return redirect()->route('courier.index')->with('success', 'Заказ успешно завершен');
}
}
