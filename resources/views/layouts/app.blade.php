<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Мета-теги, стили и скрипты -->
    </head>
    <body>
        <div>
            <!-- Шапка или навигационное меню -->
            <nav>
                <ul>
                    <li><a href="/">Главная</a></li>
                    <li><a href="{{ route('categories.index') }}">Категории</a></li>
                </ul>
            </nav>

            <!-- Основной контент -->
            <main>
                @yield('content')
            </main>
            <link rel="stylesheet" href="{{ asset('css/styles.css') }}">


            <!-- Подвал и другие общие элементы -->
            <footer>
                <!-- Здесь ваш контент для подвала, например, копирайт, ссылки и т.д. -->
            </footer>
        </div>
    </body>
</html>
