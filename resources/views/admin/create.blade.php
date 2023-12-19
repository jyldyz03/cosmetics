<!-- resources/views/admin/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Создание нового пользователя</h1>

    <form action="{{ route('admin.store') }}" method="POST">
        @csrf

        {{-- Вставьте поля формы для создания нового пользователя здесь --}}

        <button type="submit" class="btn btn-success">Создать пользователя</button>
    </form>
@endsection
