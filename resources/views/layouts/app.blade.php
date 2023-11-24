<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags, styles, and scripts -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- Include FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-ez3ndUf5DbFd+1Pd+VXR+LEHvFGhRYIs3TZuUCsKZ0nZlsukvFqVp4EnwVWx7T1U" crossorigin="anonymous">
</head>
<body>
    <div>
        <!-- Добавьте следующий код в ваше навигационное меню -->
        <nav>
            <ul>
                <li><a href="/" class="round-button">Laravel</a></li>
                <li><a href="{{ route('categories.index') }}" class="round-button">Категории</a></li>
                <li><a href="{{ route('products.index') }}" class="round-button">Главная</a></li>

                <!-- Пример добавления кнопки "Избранное" для авторизованных пользователей -->
                @auth
                    <li><a href="{{ route('favorites') }}" class="round-button">Избранное</a></li>
                @endauth

                <!-- Пример добавления кнопки "Корзина" -->
                <li><a href="{{ route('cart.index') }}" class="round-button">Корзина</a></li>

                <!-- Пример добавления кнопки "Войти" для гостей -->
                @guest
                    <li><a href="{{ route('login') }}" class="round-button">Войти</a></li>
                @else
                    <!-- Пример добавления кнопки "Выйти" для авторизованных пользователей -->
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="round-button">
                            Выйти
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endguest
            </ul>
        </nav>

        <!-- Main content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer and other common elements -->
        <footer>
            <!-- Your content for the footer, e.g., copyright, links, etc. -->
        </footer>
    </div>
</body>
</html>
