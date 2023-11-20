@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">{{ $category->name }}</h1>

        @if (isset($products) && $products->isNotEmpty())
            <ul class="list-group">
                @foreach ($products as $product)
                    <li class="list-group-item">
                        <a href="{{ route('products.show', $product->id) }}">
                            {{ $product->name }} - {{ $product->price }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="mt-4">No products found in this category.</p>
        @endif
    </div>
@endsection
