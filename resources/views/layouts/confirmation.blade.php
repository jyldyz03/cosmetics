<!-- resources/views/confirmation.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Подтверждение заказа</h1>

        <p>Номер заказа: {{ $order->id }}</p>
        <p>Комментарий: {{ $order->comment }}</p>
        <p>Способ оплаты: {{ $order->payment_method }}</p>

        <h2>Товары в заказе:</h2>
        <ul>
            @foreach ($order->orderItems as $item)
                <li>
                    Товар: {{ $item->product->name }},
                    Количество: {{ $item->quantity }},
                    Цена: {{ $item->price }}
                </li>
            @endforeach
        </ul>
    </div>
@endsection
