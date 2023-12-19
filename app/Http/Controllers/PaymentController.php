<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function showOnlinePayment()
    {
        return view('payment.online');
    }

    public function processOnlinePayment(Request $request)
    {
        // Обработка данных формы
        $cardNumber = $request->input('card_number');
        $expirationDate = $request->input('expiration_date');
        $cvc = $request->input('cvc');
        $cardHolderName = $request->input('card_holder_name');
        $phoneNumber = $request->input('phone_number');
        $email = $request->input('email');
        $amount = $request->input('amount');

        // Ваша логика обработки оплаты

        // Возвращаем представление успешной оплаты
        return view('payment.online-success');
    }
}

