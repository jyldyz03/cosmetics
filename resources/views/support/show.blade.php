<!-- resources/views/support/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h1 class="mb-0">Support Ticket Details</h1>
            </div>
            <div class="card-body">
                <h2 class="mb-3">{{ $ticket->subject }} ({{ $ticket->status === 0 ? 'Open' : 'Closed' }})</h2>
                <p class="lead">{{ $ticket->description }}</p>

                @if ($ticket->status === 0)
                    <form action="{{ route('support.close', $ticket) }}" method="post">
                        @csrf
                        @method('put')

                        <button type="submit" class="btn btn-danger">Close Ticket</button>
                    </form>
                @else
                    <p class="text-success font-weight-bold">This ticket is closed.</p>
                @endif
            </div>
            <div class="card-footer bg-light">
                <a href="{{ route('support.index') }}" class="btn btn-primary">Back to Tickets</a>
            </div>
        </div>
    </div>
@endsection
