<!-- courier.index.blade.php -->
@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h1 class="text-center mb-4">Личный кабинет курьера</h1>

    <div class="card custom-card custom-tall-card mb-2" style="height: 150px; overflow-y: auto;">
        <div class="card-header">Личные данные курьера</div>
        <div class="card-body">
            <form action="{{ route('courier.updateProfile') }}" method="post">
                @csrf
                {{ method_field('patch') }}

                <div class="mb-3">
                    <label for="name" class="form-label">Имя:</label>
                    <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="surname" class="form-label">Фамилия:</label>
                    <input type="text" name="surname" id="surname" value="{{ auth()->user()->surname }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label">Номер телефона:</label>
                    <input type="text" name="phone_number" id="phone_number" value="{{ auth()->user()->phone_number }}" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
    </div>

     <div class="card custom-card mb-4" style="max-height: 500px; overflow-y: auto;">
        <div class="card-header">Заказы курьера</div>
        <div class="card-body">
            @if ($orders->isNotEmpty())
                <ul class="list-group">
                    @foreach ($orders as $order)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Заказ №{{ $order->id }}</span> -
                            {{ $order->comment }} -
                            {{ $order->created_at }}
                            @if (!$order->completed)
                                <form action="{{ route('courier.completeOrder', ['order' => $order->id]) }}" method="post">
                                    @csrf
                                    @method('patch')
                                    <button type="submit" class="btn btn-sm" style="background-color: #6c757d; color: #fff;">Выполнено</button>
                                </form>
                            @else
                                <span class="badge bg-success">Выполнено</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">Нет назначенных вам заказов.</p>
            @endif
        </div>
    </div>
</div>

@endsection