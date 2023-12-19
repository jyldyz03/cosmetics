<!-- resources/views/clients/show_orders.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h1 class="mb-0">Client Orders</h1>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <strong>ID:</strong> {{ $client->id }}
                        </div>
                        <div class="mb-3">
                            <strong>Name:</strong> {{ $client->name }}
                        </div>
                        <div class="mb-3">
                            <strong>Email:</strong> {{ $client->email }}
                        </div>

                        <h2>Orders:</h2>
                        <ul>
                            @forelse ($orders as $order)
                                <li>
                                    Order ID: {{ $order->id }} - {{ $order->comment }} - {{ $order->created_at }}
                                </li>
                            @empty
                                <p>No orders found for this client.</p>
                            @endforelse
                        </ul>

                        <a href="{{ route('clients.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
