<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('products.index'); // Предполагается, что у вас есть файл home.blade.php в папке resources/views
    }
}
