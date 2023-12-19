<!-- resources/views/profile/edit.blade.php -->

@extends('layouts.app') <!-- Assuming you have a layout file, adjust this as needed -->

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-24">
                <div class="card custom-card">
                    <div class="card-header">Profile Information</div>

                    <div class="card-body"> <!-- Adjust the width of this div -->
                        <!-- Profile Information Form -->
                        <form method="POST" action="{{ route('profile.update') }}" class="mb-4">
                            @csrf
                            @method('PATCH')

                            <div class="input-group mb-3">
                                <span class="input-group-text">Name</span>
                                <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" class="form-control">
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text">Surname</span>
                                <input type="text" name="surname" id="surname" value="{{ auth()->user()->surname }}" class="form-control">
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text">Phone Number</span>
                                <input type="text" name="phone_number" id="phone_number" value="{{ auth()->user()->phone_number }}" class="form-control">
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text">Email</span>
                                <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">SAVE</button>
                        </form>

                        <!-- Remaining code for updating password and deleting account -->
                        <!-- ... -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
