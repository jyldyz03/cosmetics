<!-- resources/views/layouts/app.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="product-details">
        <h1>{{ $product->name }}</h1>

        <!-- Добавляем изображение продукта с размерами и отступами -->
        <img class="product-image" src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">

        <!-- Добавляем цену и описание продукта снизу фотографии -->
        <div class="product-info">
            <p><strong>Цена:</strong> {{ $product->price }}</p>
            <p>{{ $product->description }}</p>
        </div>
    </div>
@endsection