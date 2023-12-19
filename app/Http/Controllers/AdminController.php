<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $admin = auth()->id();

        $role = DB::table('users')
            ->where('id', '=', $admin)
            ->select('role')
            ->first();

        if ($role->role == 'admin') {
            $users = User::all();
            return view('admin.index', compact('users'));
        }

        return redirect()->route('products.index');
    }

    public function edit(User $user)
    {
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'surname' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
        ]);

        $data = $request->except('password', 'password_confirmation');
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->input('password'));
        }

        $user->update($data);
        return redirect()->route('admin.index')->with('success', 'Пользователь успешно обновлен.');
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'surname' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->input('password'));

        User::create($data);

        return redirect()->route('admin.index')->with('success', 'Пользователь успешно создан.');
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();

            return redirect()->route('admin.index')->with('success', 'Пользователь успешно удален.');
        } catch (\Exception $e) {
            return redirect()->route('admin.index')->with('error', 'Ошибка при удалении пользователя: ' . $e->getMessage());
        }
    }
}
