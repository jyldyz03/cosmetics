<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional stylesheets -->
    <!-- Meta tags, styles, and scripts -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- Include FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-ez3ndUf5DbFd+1Pd+VXR+LEHvFGhRYIs3TZuUCsKZ0nZlsukvFqVp4EnwVWx7T1U" crossorigin="anonymous">
    <x-auth-validation-errors :errors="$errors" />
</head>
<body class="font-sans antialiased">
    <div>
        <!-- Навигационное меню с текстом службы поддержки -->
        <nav>
            <ul>
                <!-- Служба поддержки и номер -->
                <li class="support-contact">Служба поддержки: +996559333693</li>

                <li><a href="/" class="round-button">Laravel</a></li>
                <li><a href="{{ route('categories.index') }}" class="round-button">Категории</a></li>
                <li><a href="{{ route('products.index') }}" class="round-button">Главная</a></li>
                <!-- Пример добавления кнопки "Избранное" для авторизованных пользователей -->
                @auth
                    <li><a href="{{ route('favorites') }}" class="round-button">Избранное</a></li>
                @endauth
                <!-- Пример добавления кнопки "Корзина" -->
                <li><a href="{{ route('cart.index') }}" class="round-button">Корзина</a></li>
                <!-- Пример добавления кнопки "Профиль" для авторизованных пользователей -->
                @auth
                    <li><a href="{{ route('profile.index') }}" class="round-button">Профиль</a></li>
                @endauth
                <!-- Пример добавления кнопки "Войти" для гостей -->
                @guest
                    <li><a href="{{ route('login') }}" class="round-button">Войти</a></li>
                @endguest
                <!-- Пример добавления кнопки "Выйти" для авторизованных пользователей -->
                @auth
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="round-button">Выйти</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </nav>

        <!-- Основной контент -->
        <main>
            @yield('content')
        </main>

        <!-- Футер и другие общие элементы -->
        <footer>
            <!-- Ваш контент для футера, например, авторские права, ссылки и т. д. -->
        </footer>
    </div>
</body>
</html>
