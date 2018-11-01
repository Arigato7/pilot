@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-body">
            <h3 class="h3">Редактирование данных пользователя  <span class="badge badge-primary">BETA</span></h3>
        </div>
    </div>
    <form action="#" method="post">
        @csrf
        <div class="d-flex justify-align-between mb-4">
            <div class="col-lg-6 pl-0">
                <h4 class="h4">Учетные данные</h4>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row align-items-center">
                            <label for="userLogin" class="col-sm-3 col-form-label col-form-label-lg">Логин</label>
                            <div class="col-sm-9">
                                <input type="text" name="login" class="form-control form-control-lg" id="userLogin" placeholder="Логин пользователя" value="{{ $loginData->login }}">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <label for="userPassword" class="col-sm-3 col-form-label col-form-label-lg">Пароль</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-lg" id="userPassword" placeholder="Пароль" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 pr-0">
                <h4 class="h4">Образовательная организация</h4>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row align-items-center">
                            <label for="organizationName" class="col-sm-3 col-form-label col-form-label-lg">Название</label>
                            <div class="col-sm-9">
                                <select class="form-control form-control-lg" id="organizationName" name="organization">
                                    <option>Название организации</option>
                                </select>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <label for="positionName" class="col-sm-3 col-form-label col-form-label-lg">Должность</label>
                            <div class="col-sm-9">
                                <select class="form-control form-control-lg" id="positionName" name="position">
                                    <option>Должность</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-align-between mb-4">
            <div class="col-lg-6 pl-0">
                <h4 class="h4">Контактные данные</h4>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row align-items-center">
                            <label for="userEmail" class="col-sm-3 col-form-label col-form-label-lg">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" class="form-control form-control-lg" id="userEmail" placeholder="email">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <label for="userTel" class="col-sm-3 col-form-label col-form-label-lg">Телефон</label>
                            <div class="col-sm-9">
                                <input type="text" name="phone" class="form-control form-control-lg" id="userTel" placeholder="Номер телефона">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 pr-0">
                <h4 class="h4">Системные данные</h4>
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <label for="roleName" class="col-sm-3 col-form-label col-form-label-lg">Роль</label>
                            <div class="col-sm-9">
                                <select class="form-control form-control-lg" id="roleName" name="role">
                                    <option>Роль</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <h4 class="h4">Данные пользователя</h4>
            <div class="card">
                <div class="card-body">
                    <div class="form-group row align-items-center">
                        <label for="userName" class="col-sm-3 col-form-label col-form-label-lg">Имя</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control form-control-lg" id="userName" placeholder="Имя">
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <label for="userLastname" class="col-sm-3 col-form-label col-form-label-lg">Фамилия</label>
                        <div class="col-sm-9">
                            <input type="text" name="lastname" class="form-control form-control-lg" id="userLastname" placeholder="Фамилия">
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <label for="userMiddlename" class="col-sm-3 col-form-label col-form-label-lg">Отчество</label>
                        <div class="col-sm-9">
                            <input type="text" name="middlename" class="form-control form-control-lg" id="userMiddlename" placeholder="Отчество">
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <label for="userAbout" class="col-sm-3 col-form-label col-form-label-lg">О себе</label>
                        <div class="col-sm-9">
                            <textarea name="about" id="userAbout" class="form-control form-control-lg" cols="30" rows="5" placeholder="О себе"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body text-right">
                <button type="button" class="btn btn-success btn-lg">Сохранить</button>
                <a href="#" class="btn btn-lg btn-primary">Отмена</a>
            </div>
        </div>
    </form>
</div>
@endsection