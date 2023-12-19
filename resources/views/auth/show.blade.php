@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Your Profile') }}</div>

                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $user->name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <!-- Добавьте дополнительные поля по мере необходимости -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
