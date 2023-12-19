<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ConfirmationController extends Controller
{
    public function showConfirmation(Order $order)
    {
        return view('confirmation', ['order' => $order]);
    }
}