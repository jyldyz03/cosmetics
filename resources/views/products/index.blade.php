@extends('layouts.app')

@section('content')
    <h1 class="text-center">Главная страница</h1>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    @if ($products->isNotEmpty())
        <h2>Все продукты</h2>

        <div class="row">
            @foreach ($products as $index => $product)
                <div class="col-md-4">
                    <ul>
                        <li>
                            <a href="{{ route('products.show', $product->id) }}">
                                {{ $product->name }} - {{ $product->price }}
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" style="max-width: 100px;">
                            </a>
                        </li>
                    </ul>
                </div>

                @if (($index + 1) % 3 === 0)
                    </div><div class="row">
                @endif
            @endforeach
        </div>
    @else
        <p>No products found.</p>
    @endif
@endsection
