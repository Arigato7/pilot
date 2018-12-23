@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="h1 mb-4 text-center">Подача заявки на регистрацию</h1>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('application.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="userName" class="col-form-label text-secondary col-md-4 col-form-label text-md-right">Имя</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="userName" placeholder="Ваше имя" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="userLastname" class="col-form-label text-secondary col-md-4 col-form-label text-md-right">Фамилия</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" id="userLastname" placeholder="Ваша фамилия" value="{{ old('lastname') }}" required>
                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Логин</label>
                            <div class="col-md-6">
                                <input id="login" type="text" class="form-control{{ $errors->has('login') ? ' is-invalid' : '' }}" name="login" value="{{ old('login') }}" placeholder="Ваш логин" required>
                                @if ($errors->has('login'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('login') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">email</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" placeholder="Ваш email" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Телефон</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" placeholder="Ваш номер телефона" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Подать заявку
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
