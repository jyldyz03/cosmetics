<!-- resources/views/admin/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Редактирование данных пользователя</h1>

    <form action="{{ route('admin.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="surname" class="form-label">Surname</label>
            <input type="text" name="surname" id="surname" value="{{ $user->surname }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" value="{{ $user->phone_number }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
    </form>
@endsection
