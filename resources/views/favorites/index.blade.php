<!-- resources/views/favorites/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Избранное</h1>

        @if ($products->isNotEmpty())
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <img class="bd-placeholder-img card-img-top" src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" style="max-height: 225px; object-fit: cover;">
                            <div class="card-body">
                                <p class="card-text">{{ $product->name }} - {{ $product->price }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-outline-secondary">Подробнее</a>
                                        {{-- Remove from Favorites button with heart icon --}}
                                        <form action="{{ route('products.removeFromFavorites', $product->id) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-sm btn-outline-danger ml-2">
                                                <i class="fas fa-heart"></i> Убрать из избранного
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No favorite products found.</p>
        @endif
    </div>
@endsection
