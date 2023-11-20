@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Категории</h1>

        @if ($categories->isNotEmpty())
            <ul class="list-group">
                @foreach ($categories as $category)
                    <li class="list-group-item">
                        <a href="{{ route('categories.show', $category->id) }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="mt-4">No categories found.</p>
        @endif
    </div>
@endsection
