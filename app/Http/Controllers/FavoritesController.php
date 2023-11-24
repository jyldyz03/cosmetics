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
    // Logic for retrieving user's favorites
    $products = auth()->user()->favorites; // Assuming you have a relationship set up

    return view('favorites.index', ['products' => $products]);
}
}



