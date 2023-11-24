@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Search Results</h1>

        <p>Results for: {{ urldecode($query) }}</p>

        <form action="{{ route('products.search') }}" method="GET">
            <div class="input-group mb-3">
                <input type="text" name="query" class="form-control" placeholder="Search products" aria-label="Search products" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" id="button-addon2">Search</button>
                </div>
            </div>
        </form>

        @if(count($products) > 0)
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <img class="bd-placeholder-img card-img-top" src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" style="max-height: 225px; object-fit: cover;">
                            <div class="card-body">
                                <p class="card-text">{{ $product->name }} - {{ $product->price }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-outline-secondary">View</a>
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
