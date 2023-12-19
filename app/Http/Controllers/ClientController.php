<?php

// app/Http/Controllers/ClientController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Отображение списка клиентов.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $admin = auth()->id();

        $role = DB::table('users')
            ->where('id', '=', $admin)
            ->select('role')
            ->first();

        // Проверка, является ли роль пользователя 'manage'
        if ($role->role == 'manage') {
            $search = $request->input('search');
            $clients = User::where('role', 'client')
                ->when($search, function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%");
                })
                ->get();

            return view('clients.index', compact('clients', 'search'));
        }

        // Если роль пользователя не 'manage', перенаправляем его на products.index
        return redirect()->route('products.index');
    }

    /**
     * Отображение информации о конкретном клиенте.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */

    /**
     * Фильтрация и поиск клиентов.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function filter(Request $request)
    {
        $search = $request->input('search');

        $clients = User::where('role', 'client')
            ->where('name', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%")
            ->get();

        return view('clients.index', compact('clients', 'search'));
    }
    public function showOrders($id)
{
    $client = User::findOrFail($id);
    $orders = Order::where('user_id', $id)->get();

    return view('clients.show', compact('client', 'orders'));
}
 public function show($id)
{
    $client = User::findOrFail($id);
    $orders = Order::where('user_id', $id)->get();


    return view('clients.show', compact('client', 'orders'));
}

public function accept($id)
{
    $order = Order::findOrFail($id);

    // Добавьте здесь код для принятия заказа, например, пометьте его как принятый в базе данных
    $order->update(['status' => 'accepted']);

    return redirect()->back()->with('success', 'Заказ успешно принят');
}

}
