<!-- resources/views/admin/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Список пользователей</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-primary">Редактировать</a>
                        <form action="{{ route('admin.destroy', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Нет пользователей.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
