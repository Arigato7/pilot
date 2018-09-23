<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style> 
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .smart-row {
                display: flex;
                justify-content: center;
                align-items: center;
            }
            a.smart-block {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100px;
                height: 100px;
                padding: 5rem;
                outline-width: 1px;
                outline-color: #636b6f;
                outline-offset: 0;
                outline-style: solid;
                transition: outline-offset ease-in 0.1s;
            }
            a.smart-block:hover {
                outline-offset: -45px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ route('materials') }}">На главную</a>
                    @else
                        <a href="{{ route('login') }}">Войти</a>
                        <a href="{{ route('register') }}">Регистрация</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Пилот
                </div>

                <div class="links">
                    @guest
                    <a href="{{ route('news') }}" class="nav-link smart-block">Новости</a>
                    @else
                    <div class="smart-row">
                        <a href="{{ route('materials') }}" class="nav-link smart-block">Депозиторий</a>
                        <a href="{{ route('courses') }}" class="nav-link smart-block">Повышение квалификации</a>
                        <a href="{{ route('news') }}" class="nav-link smart-block">Новости</a>
                    </div>    
                    @endguest
                </div>
            </div>
        </div>
    </body>
</html>
