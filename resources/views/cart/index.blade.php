@extends('layouts.app')

@section('content')
    <div class="container cart-container">
        <h1 class="text-center">Корзина</h1>

        @if ($cart && $cart->products->isNotEmpty())

            <table class="table table-striped cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalAmount = 0;
                        $totalQuantity = 0;
                    @endphp

                    @foreach ($cart->products as $product)
                        <tr>
                            <td class="align-middle">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" style="max-width: 80px; max-height: 80px; border-radius: 8px; margin-right: 15px;">
                                    {{ $product->name }}
                                </div>
                            </td>
                            <td class="align-middle">{{ $product->price }}</td>
                            <td class="align-middle">
                                <form action="{{ route('cart.update', $product) }}" method="post" class="d-flex align-items-center">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $product->pivot->quantity }}" min="1" class="form-control mr-2" style="width: 60px;">
                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                </form>
                            </td>
                            @php
                                $productTotal = $product->price * $product->pivot->quantity;
                                $totalAmount += $productTotal;
                                $totalQuantity += $product->pivot->quantity;
                            @endphp
                            <td class="align-middle">{{ $productTotal }}</td>
                            <td class="align-middle">
                                <form action="{{ route('cart.remove', $product) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="cart-total">
                <h4 class="total-quantity">Total Quantity: {{ $totalQuantity }} item(s)</h4>
                <h4 class="total-payment">Total Payment: ${{ $totalAmount }}</h4>
            </div>
            <!-- Добавление кнопки "Купить" и формы оформления заказа -->
            <div class="mt-4">
                <a href="{{ route('checkout', ['totalAmount' => $totalAmount, 'payment_method' => 'online']) }}" class="btn btn-primary">Оформить заказ</a>
            </div>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
@endsection