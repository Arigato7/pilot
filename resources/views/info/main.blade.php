@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1 mb-4">О системе</h1>
    <div class="d-flex justify-content-between">
        <div class="col-4 pl-0">
            <div class="card">
                <div class="card-header">Содержание</div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <a href="{{ route('info') }}">Главная</a>
                        </div>
                        <div class="list-group-item">
                            <a href="#">Основы</a>
                            <ul class="list-group list-group-flush">
                                <div class="list-group-item">
                                    <a href="#">Личный кабинет</a>
                                </div>
                                <div class="list-group-item">
                                    <a href="#">Материалы</a>
                                </div>
                                <div class="list-group-item">
                                    <a href="#">Курсы повышения квалификации</a>
                                </div>
                                <div class="list-group-item">
                                    <a href="#">Дистанционное обучение</a>
                                </div>
                                <div class="list-group-item">
                                    <a href="#">Новости</a>
                                </div>
                            </ul>
                        </div>
                        <div class="list-group-item">
                            <a href="#">Модерация</a>
                            <ul class="list-group list-group-flush">
                                <div class="list-group-item">
                                    <a href="#">Жалобы на материалы</a>
                                </div>
                                <div class="list-group-item">
                                    <a href="#">Комментарии к курсам</a>
                                </div>
                                <div class="list-group-item">
                                    <a href="#">Комментарии к материалам</a>
                                </div>
                            </ul>
                        </div>
                        <div class="list-group-item">
                            <a href="#">Администрирование</a>
                            <ul class="list-group list-group-flush">
                                <div class="list-group-item">
                                    <a href="#">Пользователи</a>
                                </div>
                                <div class="list-group-item">
                                    <a href="#">Образовательные организации</a>
                                </div>
                                <div class="list-group-item">
                                    <a href="#">Должности</a>
                                </div>
                                <div class="list-group-item">
                                    <a href="#">Типы материалов</a>
                                </div>
                                <div class="list-group-item">
                                    <a href="#">Типы курсов</a>
                                </div>
                                <div class="list-group-item">
                                    <a href="#">Специальности</a>
                                </div>
                                <div class="list-group-item">
                                    <a href="#">Дисциплины</a>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8 pr-0">
            <div class="card">
                <div class="card-header">Главная</div>
                <div class="card-body">
                    text
                </div>
            </div>
        </div>
    </div>
</div>
@endsection