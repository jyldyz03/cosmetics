<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    /**
     * Display the user's favorites.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Получаем текущего пользователя
        $user = auth()->user();

        // Получаем избранные продукты для текущего пользователя
        $products = $user->favorites;

        return view('favorites.index', ['products' => $products]);
    }
}
