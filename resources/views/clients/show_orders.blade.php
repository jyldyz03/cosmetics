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

        @forelse ($orders ?? [] as $order)
            <div class="card mb-2">
                <div class="card-body">
                    Order ID: {{ $order->id }}<br>
                    Comment: {{ $order->comment }}<br>
                    Created At: {{ $order->created_at }}
                </div>
            </div>
        @empty
            <p class="text-muted">No orders found for this client.</p>
        @endforelse

        <a href="{{ route('clients.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
@endsection
