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
            <div class="col-lg-6">
                <h4 class="h4">Учетные данные</h4>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row align-items-center">
                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-llg">Логин</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control form-control-lg" id="colFormLabelSm" placeholder="col-form-label-sm">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-llg">Пароль</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control form-control-lg" id="colFormLabelSm" placeholder="col-form-label-sm" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h4 class="h4">Образовательная организация</h4>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row align-items-center">
                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-llg">Организация</label>
                            <div class="col-sm-9">
                                <select class="form-control form-control-lg">
                                    <option>Large select</option>
                                </select>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-llg">Должность</label>
                            <div class="col-sm-9">
                                <select class="form-control form-control-lg">
                                    <option>Large select</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-align-between">
            <div class="col-lg-6">
                <h4 class="h4">Контактные данные</h4>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row align-items-center">
                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-llg">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control form-control-lg" id="colFormLabelSm" placeholder="col-form-label-sm">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-llg">Телефон</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control form-control-lg" id="colFormLabelSm" placeholder="col-form-label-sm" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h4 class="h4">Системные данные</h4>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row align-items-center">
                            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-llg">Роль</label>
                            <div class="col-sm-9">
                                <select class="form-control form-control-lg">
                                    <option>Large select</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection