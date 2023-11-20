<!-- resources/views/products/show.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>{{ $product->name }}</h1>
    <p>Цена: {{ $product->price }}</p>
    <p>{{ $product->description }}</p>
    <!-- Дополнительная информация о продукте -->
@endsection
