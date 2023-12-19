@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card custom-card custom-tall-card">
                    <div class="card-header">Profile Information</div>

                    <div class="card-body">
                        <!-- Profile Information Form -->
                        <form method="POST" action="{{ route('profile.update') }}" class="mb-4">
                            @csrf
                            @method('PATCH')

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="surname" class="form-label">Surname</label>
                                <input type="text" name="surname" id="surname" value="{{ auth()->user()->surname }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="text" name="phone_number" id="phone_number" value="{{ auth()->user()->phone_number }}" class="form-control">
                            </div>

                              <button type="submit" class="btn btn-primary">SAVE</button>
                        </form>

                        <hr>

                        <h2>История заказов</h2>

                        @foreach($orders as $order)
    <li class="list-group-item">
        <strong>Заказ №{{ $order->id }} - {{ $order->created_at->format('d.m.Y') }}</strong>
        <ul>
            @foreach($order->items as $item)
                <li>{{ $item->product->name }} - {{ $item->quantity }} шт.</li>
            @endforeach
        </ul>
        <strong>Итого: ${{ $order->total_amount }}</strong>
        <!-- Вставьте следующую строку для отображения метода оплаты -->
        <p>Метод оплаты:
            @if($order->payment_method === 'cash')
                Наличные
            @elseif($order->payment_method === 'online')
                Онлайн
            @else
                {{ $order->payment_method }}
            @endif
        </p>
    </li>
@endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection