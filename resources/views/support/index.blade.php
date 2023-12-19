<!-- resources/views/support/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Support Tickets</h1>

        @if ($tickets->isEmpty())
            <div class="alert alert-info">
                No support tickets yet.
            </div>
        @else
            <ul class="list-group">
                @foreach ($tickets as $ticket)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">
                                    <a href="{{ route('support.show', $ticket) }}" class="text-decoration-none">
                                        {{ $ticket->subject }}
                                    </a>
                                </h5>
                                <small>Status: {{ $ticket->status === 0 ? 'Open' : 'Closed' }}</small>
                            </div>
                            <span class="badge badge-primary badge-pill">
                                {{ $ticket->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif

        <div class="mt-4">
            <a href="{{ route('support.create') }}" class="btn btn-primary">Create New Ticket</a>
        </div>
    </div>
@endsection
