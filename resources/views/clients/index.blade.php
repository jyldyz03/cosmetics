<!-- resources/views/clients/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>List of Clients</h1>

    <form action="{{ route('clients.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ $search ?? '' }}">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    @if($search)
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
