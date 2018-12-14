@extends('layouts.app')

@section('content')
<div class="container">
    <div class="display-3 text-center my-3">
        <div class="fa fa-2x fa-graduation-cap"></div>
        <div>Пилот</div>
    </div>
    <div class="jumbotron">
        <h1 class="display-4">Здравствуйте!</h1>
        <div class="lead mb-2">Вы находитесь на главной странице интернет-ресурса "Пилот". На данный момент, система находится на стадии активного тестирования и разработки, в связи с чем возможно возникновение непредвиденных ситуаций.</div>
        <div class="lead mb-2">
            В число подобных ситуаций входят:
            <ul class="my-2">
                <li>Изменения в пользовательском интерфейсе</li>
                <li>Изчезновение данных пользователей</li>
                <li>Внезапное прекращение работы системы</li>
            </ul>
        </div>
        <div class="lead">
            <i>На стадии тестирования и разработки интернет ресурса, администрация не несет <em>никакой</em> ответственности за данные пользователей в рамках самой системы. Персональные данные пользователей используются в соответствии с Федеральным законом от 27.07.2006 N 152-ФЗ (ред. от 31.12.2017) "О персональных данных".</i>
        </div>
        <hr class="my-4">
        @guest
        <p>Для того чтобы узнать начать работу в системе, войдите или подайте заявку на регистрацию.</p>
        <div class="btn-group">
            <a class="btn btn-primary btn-lg" href="{{ route('login') }}" role="button">Войти</a>
            <a class="btn btn-light btn-lg" href="{{ route('register') }}" role="button">Подать заявку</a>   
        </div>
        @else
        <p>Для того чтобы описание системы, перейдите по ссылке ниже.</p>
        <a class="btn btn-primary btn-lg" href="#" role="button">Узнать больше</a>
        @endguest
    </div>
</div>
@endsection