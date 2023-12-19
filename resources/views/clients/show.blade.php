@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Client Orders</h1>

        <div class="card mb-4">
            <div class="card-body">
                <strong>ID:</strong> {{ $client->id }}<br>
                <strong>Name:</strong> {{ $client->name }}<br>
                <strong>Email:</strong> {{ $client->email }}<br>
            </div>
        </div>

        <h2>Orders:</h2>

        @forelse ($orders as $order)
            <div class="card mb-2">
                <div class="card-body">
                    Order ID: {{ $order->id }}<br>
                    Comment: {{ $order->comment }}<br>
                    Created At: {{ $order->created_at }}

                    @if ($order->status == 'pending')
                        <form action="{{ route('orders.accept', ['id' => $order->id]) }}" method="post">
                            @csrf
                            @method('patch')
                            <button type="submit" class="btn btn-sm btn-light">Принять заказ</button>
                        </form>
                    @else
                        <span class="badge bg-success">Заказ выполнен</span>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-muted">No orders found for this client.</p>
        @endforelse
    </div>
@endsection
