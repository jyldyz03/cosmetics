<!-- resources/views/clients/filter.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Filtered Clients</h1>

    <form action="{{ route('clients.filter') }}" method="GET">
        <div class="mb-3">
            <label for="search" class="form-label">Search:</label>
            <input type="text" name="search" id="search" class="form-control" value="{{ $search ?? '' }}">
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    @if(isset($search))
        <p>Search results for: {{ $search }}</p>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->email }}</td>
                    <td>
                        <a href="{{ route('clients.show', $client->id) }}" class="btn btn-primary">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No clients found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
