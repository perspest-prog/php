<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Things</title>

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @viteReactRefresh
            @vite(['resources/css/app.css', 'resources/js/app.tsx'])
        @endif
    </head>
    <body>
        <header>
            @auth
                <nav>
                    <details>
                        <summary>Вещи</summary>
                        <a href="{{ route('things.index') }}">Общий список</a>
                        <a href="{{ route('things.index', ['filter' => 'my']) }}">Мои вещи</a>
                        <a href="{{ route('things.index', ['filter' => 'inRepair']) }}">Вещи в repair</a>
                        <a href="{{ route('things.index', ['filter' => 'inWork']) }}">Вещи в работе</a>
                        <a href="{{ route('things.index', ['filter' => 'inUsage']) }}">Мои вещи в usage</a>
                    </details>
                </nav>
                <span>{{ auth()->user()->name }}</span>
            @endauth
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-success mr-5">Вход</a>
                <a href="{{ route('register') }}" class="btn btn-outline-success">Регистрация</a>
            @endguest
            @auth
                <a href="{{ route('logout') }}" class="btn btn-outline-success">Выйти</a>
            @endauth
            <a href="{{ route('index') }}">Главная страница</a>
            <div id="notifications"></div>
        </header>

        <main>
            @yield('content')
        </main>
    </body>
</html>
