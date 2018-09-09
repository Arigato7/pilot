<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Pilot') }} :: Пилот</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="w-100">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Pilot') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest
                        <li class="nav-item">
                            <a href="{{ route('news') }}" class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Список новостей">Новости</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="{{ route('materials') }}" class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Популярные и новые материалы">Материалы</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('educationOrganizations') }}" class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Список образовательных организаций">Образовательные организации</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('news') }}" class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Список оповещений">Оповещения</a>
                        </li>
                        @can ('moderate', Auth::user())
                        <li class="nav-item">
                            <a href="{{ route('materialComplaints') }}" class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Список жалоб на материалы">Жалобы на материалы</a>
                        </li>
                        @endcan
                        @can ('administrate', Auth::user())
                        <li class="nav-item">
                            <a href="{{ route('users') }}" class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Список пользователей">Пользователи</a>
                        </li>
                        @endcan
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">Войти</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">Регистрация</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->login }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/user/{{ Auth::user()->login }}">
                                        Профиль
                                     </a>
                                     <a class="dropdown-item" href="/user/{{ Auth::user()->login }}/settings">
                                        Настройки
                                     </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Выход
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="bg-white border-top">
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <ul class="navbar-nav mx-auto">
                        @guest
                        <li class="nav-item">
                            <a href="{{ route('news') }}" class="nav-link">Новости</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="{{ route('materials') }}" class="nav-link">Материалы</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('educationOrganizations') }}" class="nav-link">Образовательные организации</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('news') }}" class="nav-link">Новости</a>
                        </li>
                        @can ('administrate', Auth::user())
                        <li class="nav-item">
                            <a href="{{ route('users') }}" class="nav-link">Пользователи</a>
                        </li>
                        @endcan
                        @endguest
                    </ul>
                </div>
            </nav>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
