<!-- resources/views/products/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1 class="text-center">Главная страница</h1>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    @if ($products->isNotEmpty())
        <h2>Все продукты</h2>
        <ul>
            @foreach ($products as $product)
                <li>
                    <a href="{{ route('products.show', $product->id) }}">
                        {{ $product->name }} - {{ $product->price }}
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" style="max-width: 100px;">
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <p>No products found.</p>
    @endif
@endsection
