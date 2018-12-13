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
                    Пилот
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
                        @can ('teach', Auth::user())
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Депозиторий <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('materials') }}" class="nav-link" data-toggle="tooltip" data-placement="left" title="Список материалов">Главная</a>
                                <a class="dropdown-item" href="{{ route('materials.create') }}" class="nav-link" data-toggle="tooltip" data-placement="left" title="Создание материала">Создать материал</a>
                            </div>
                        </li>
                        @endcan
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Обучение <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @can ('teach', Auth::user())
                                <a class="dropdown-item" href="{{ route('courses') }}" class="nav-link" data-toggle="tooltip" data-placement="left" title="Повышение квалификации">Курсы повышения квалификации</a>
                                @endcan
                                <a class="dropdown-item" href="{{ route('practicals') }}" class="nav-link" data-toggle="tooltip" data-placement="left" title="Дистанционное обучение">Дистанционное обучение</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Новости <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('news') }}" class="nav-link" data-toggle="tooltip" data-placement="left" title="Новости">Все новости</a>
                                @can ('administrate', Auth::user())
                                <a class="dropdown-item" href="{{ route('news.create') }}" class="nav-link" data-toggle="tooltip" data-placement="left" title="Создание новости">Создать новость</a>
                                @endcan
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('organizations') }}" class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Список образовательных организаций">Образовательные организации</a>
                        </li>
                        @can ('teach', Auth::user())
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                О системе <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('info') }}" class="nav-link" data-toggle="tooltip" data-placement="left" title="Основная информация о системе">Главная</a>
                                <a class="dropdown-item" href="#" class="nav-link" data-toggle="tooltip" data-placement="left" title="Основная информация о системе">Основы</a>
                                @can ('moderate', Auth::user())
                                <a class="dropdown-item" href="#" class="nav-link" data-toggle="tooltip" data-placement="left" title="Основная информация о системе">Модерация</a>
                                @endcan
                                @can ('administrate', Auth::user())
                                <a class="dropdown-item" href="#" class="nav-link" data-toggle="tooltip" data-placement="left" title="Основная информация о системе">Администрирование</a>
                                @endcan
                            </div>
                        </li>
                        @endcan
                        @can ('administrate', Auth::user())
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Администрирование <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('users') }}" class="nav-link" data-toggle="tooltip" data-placement="left" title="Список пользователей">
                                    Пользователи
                                </a>
                                <a class="dropdown-item" href="{{ route('positions') }}" class="nav-link" data-toggle="tooltip" data-placement="left" title="Редактирование должностей">Должности</a>
                                <a class="dropdown-item" href="{{ route('materials.types') }}" class="nav-link" data-toggle="tooltip" data-placement="left" title="Редактирование типов материалов">Типы материалов</a>
                                <a class="dropdown-item" href="{{ route('courses.types') }}" class="nav-link" data-toggle="tooltip" data-placement="left" title="Редактирование типов курсов">Типы курсов</a>
                                <a class="dropdown-item" href="{{ route('specialties') }}" class="nav-link" data-toggle="tooltip" data-placement="left" title="Редактирование специальностей">Специальности</a>
                                <a class="dropdown-item" href="{{ route('subjects') }}" class="nav-link" data-toggle="tooltip" data-placement="left" title="Редактирование дисциплин">Дисциплины</a>
                            </div>
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
                                        <i class="fa fa-address-card mr-1"></i>
                                        Профиль
                                     </a>
                                     <a class="dropdown-item" href="/user/{{ Auth::user()->login }}/settings">
                                        <i class="fa fa-cog mr-1"></i>
                                        Настройки
                                     </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out mr-1"></i>            
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

        <footer class="py-5">
            <div class="text-secondary text-center">
                АПОУ "ИПЭК" 2018 год
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
