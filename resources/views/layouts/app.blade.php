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
<body class="air">
    <div id="app" class="w-100">
        <nav class="navbar navbar-expand-md navbar-light air__navbar">
            <div class="container">
                <a class="navbar-brand d-flex justify-content-start align-items-center" href="{{ url('/') }}">
                    <img src="https://img.icons8.com/color/38/000000/christmas-tree.png">Пилот
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
                                <a class="dropdown-item d-flex justify-content-start align-items-center" href="{{ route('materials') }}" class="nav-link" data-toggle="tooltip" data-placement="left" title="Список материалов">
                                    <i class="fa fa-home mr-2"></i>Главная
                                </a>
                                <a class="dropdown-item d-flex justify-content-start align-items-center" href="{{ route('materials.create') }}" class="nav-link" data-toggle="tooltip" data-placement="left" title="Создание материала">
                                    <i class="fa fa-plus mr-2"></i>Создать материал
                                </a>
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
                                <a class="dropdown-item d-flex justify-content-start align-items-center" href="{{ route('news') }}" class="nav-link" data-toggle="tooltip" data-placement="left" title="Новости">
                                    <i class="fa fa-home mr-2"></i>Главная
                                </a>
                                @can ('administrate', Auth::user())
                                <a class="dropdown-item d-flex justify-content-start align-items-center" href="{{ route('news.create') }}" class="nav-link" data-toggle="tooltip" data-placement="left" title="Создание новости">
                                    <i class="fa fa-plus mr-2"></i>Создать новость
                                </a>
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
                                <a class="dropdown-item d-flex justify-content-start align-items-center" href="{{ route('users') }}" class="nav-link" data-toggle="tooltip" data-placement="left" title="Список пользователей">
                                    <i class="fa fa-user-circle mr-2"></i>Пользователи
                                </a>
                                <a class="dropdown-item d-flex justify-content-start align-items-center" href="{{ route('positions') }}" class="nav-link" data-toggle="tooltip" data-placement="left" title="Редактирование должностей">
                                    <i class="fa fa-wrench mr-2"></i>Должности
                                </a>
                                <a class="dropdown-item d-flex justify-content-start align-items-center" href="{{ route('materials.types') }}" class="nav-link" data-toggle="tooltip" data-placement="left" title="Редактирование типов материалов">
                                    <i class="fa fa-book mr-2"></i>Типы материалов
                                </a>
                                <a class="dropdown-item d-flex justify-content-start align-items-center" href="{{ route('courses.types') }}" class="nav-link" data-toggle="tooltip" data-placement="left" title="Редактирование типов курсов">
                                    <i class="fa fa-book mr-2"></i>Типы курсов
                                </a>
                                <a class="dropdown-item d-flex justify-content-start align-items-center" href="{{ route('specialties') }}" class="nav-link" data-toggle="tooltip" data-placement="left" title="Редактирование специальностей">
                                    <i class="fa fa-book mr-2"></i>Специальности
                                </a>
                                <a class="dropdown-item d-flex justify-content-start align-items-center" href="{{ route('subjects') }}" class="nav-link" data-toggle="tooltip" data-placement="left" title="Редактирование дисциплин">
                                    <i class="fa fa-book mr-2"></i>Дисциплины
                                </a>
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
                                    <a class="dropdown-item d-flex justify-content-start align-items-center" href="/user/{{ Auth::user()->login }}">
                                        <i class="fa fa-address-card mr-2"></i>
                                        Профиль
                                     </a>
                                     <a class="dropdown-item d-flex justify-content-start align-items-center" href="/user/{{ Auth::user()->login }}/settings">
                                        <i class="fa fa-cog mr-2"></i>
                                        Настройки
                                     </a>
                                    <a class="dropdown-item d-flex justify-content-start align-items-center" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out mr-2"></i>            
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

        <main class="py-5 mt-5">
            @yield('content')
        </main>

        <footer class="py-4">
            <div class="text-secondary text-center">
                АПОУ УР "ИПЭК" 2018 год
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
