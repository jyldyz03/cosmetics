@extends('layouts.app')

@section('content')
    <div class="product-details">
        <h1>{{ $product->name }}</h1>

        <!-- Добавляем изображение продукта с размерами и отступами -->
        <img class="product-image" src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">

        <!-- Добавляем цену и описание продукта с учетом скидок и купонов -->
        <div class="product-info">
            <p><strong>Цена:</strong> {{ formatPrice($product->getDiscountedPrice()) }}</p>
            <p>{{ $product->description }}</p>
        </div>
    </div>
@endsection
