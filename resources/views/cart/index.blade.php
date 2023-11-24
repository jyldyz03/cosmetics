@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Корзина</h1>

        @if ($cart && $cart->products->isNotEmpty())

            <table class="table">
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
                    <?php $totalAmount = 0; ?>
                    @foreach ($cart->products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                <form action="{{ route('cart.update', $product) }}" method="post">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $product->pivot->quantity }}" min="1">
                                    <button type="submit">Update</button>
                                </form>
                            </td>
                            <?php $productTotal = $product->price * $product->pivot->quantity; ?>
                            <td>{{ $productTotal }}</td>
                            <?php $totalAmount += $productTotal; ?>
                            <td>
                                <form action="{{ route('cart.remove', $product) }}" method="post">
                                    @csrf
                                    <button type="submit">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3">
                <h4>Total Amount: ${{ $totalAmount }}</h4>
            </div>

        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
@endsection
