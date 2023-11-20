@extends('layouts.app')

@section('content')
    <h1 class="text-center">Продукты в выбранной категории</h1>

    @if ($products->isNotEmpty())
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
        <p>No products found in this category.</p>
    @endif
@endsection
