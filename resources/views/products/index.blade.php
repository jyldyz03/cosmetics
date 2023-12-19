@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Главная страница</h1>

        <form action="{{ route('products.search') }}" method="GET" class="search-form">
            <div class="input-group mb-3">
                <input type="text" name="query" class="form-control" placeholder="Поиск продуктов" aria-label="Поиск продуктов" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" id="button-addon2">Поиск</button>
                </div>
            </div>
        </form>

        @if ($products->isNotEmpty())
            <h2>Все продукты</h2>

            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <img class="bd-placeholder-img card-img-top" src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                            <div class="card-body">
                                <p class="card-text">{{ $product->name }} - {{ $product->price }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-outline-secondary">Подробнее</a>

                                        {{-- Add to Cart button --}}
                                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success ml-2">
                                                <i class="fas fa-shopping-cart"></i> В корзину
                                            </button>
                                        </form>

                                        @auth
                                            {{-- Add to Favorites button with heart icon --}}
                                            <form action="{{ route('products.addToFavorites', $product->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger ml-2 favorite-button">
                                                    <i class="fas fa-heart"></i> <!-- оставьте эту часть, если у вас есть соответствующая икона -->
                                                </button>
                                            </form>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No products found.</p>
        @endif
    </div>
@endsection
