<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Мета-теги, стили и скрипты -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div>
        <!-- Шапка или навигационное меню -->
        <nav>
            <ul>
                <li><a href="/">Laravel</a></li>
                <li><a href="{{ route('categories.index') }}">Категории</a></li>
                <!-- Добавляем кнопку "На главную" в шапку -->
                <li><a href="{{ route('products.index') }}">Главная</a></li>
            </ul>
        </nav>

        <!-- Основной контент -->
        <main>
            @yield('content')
        </main>

        <!-- Подвал и другие общие элементы -->
        <footer>
            <!-- Здесь ваш контент для подвала, например, копирайт, ссылки и т.д. -->
        </footer>
    </div>
</body>
</html>
