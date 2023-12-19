<!-- resources/views/support/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Create Support Ticket</h1>

        <form action="{{ route('support.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" name="subject" id="subject" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Ticket</button>
        </form>
    </div>
@endsection
