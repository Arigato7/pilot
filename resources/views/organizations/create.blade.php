@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card create-organization">
        <div class="card-header">
            Добавление образовательной организации
        </div>
        <div class="card-body">
            @can ('administrate', Auth::user())
            <form action="{{ route('organizations.store') }}" method="POST" name="createMaterial" enctype="multipart/form-data">
                @csrf
                <label for="organizationShortName" class="col-form-label text-secondary">Сокращенное название образовательной организации</label>
                <input type="text" class="form-control{{ $errors->has('shortname') ? ' is-invalid' : '' }}" name="shortname" id="organizationShortName" placeholder="Введите сокращенное название организации" value="{{ old('shortname') }}">
                @if ($errors->has('shortname'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('shortname') }}</strong>
                    </span>
                @endif
                <label for="organizationName" class="col-form-label text-secondary">Полное название образовательной организации</label>
                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="organizationName" placeholder="Введите полное название организации" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
                <label for="organizationCite" class="col-form-label text-secondary">Сайт</label>
                <input type="text" class="form-control{{ $errors->has('cite') ? ' is-invalid' : '' }}" name="cite" id="organizationCite" placeholder="Введите сайт организации" value="{{ old('cite') }}">
                @if ($errors->has('cite'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('cite') }}</strong>
                    </span>
                @endif
                <label for="organizationEmail" class="col-form-label text-secondary">Email</label>
                <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="organizationEmail" placeholder="Введите email организации" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <label for="organizationTel" class="col-form-label text-secondary">Телефон</label>
                <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" id="organizationTel" placeholder="Введите номер телефона организации" value="{{ old('phone') }}">
                @if ($errors->has('phone'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
                <label for="organizationAddress" class="col-form-label text-secondary">Адрес образовательной организации</label>
                <input type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" id="organizationAddress" placeholder="Введите адрес организации" value="{{ old('address') }}">
                @if ($errors->has('address'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
                <label for="organizationDescription" class="col-form-label text-secondary">Описание</label>
                <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="organizationDescription" cols="30" rows="10" placeholder="Введите описание образовательной организации">{{ old('description') }}</textarea>
                @if ($errors->has('description'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
                <label for="organizationPhoto" class="col-form-label text-secondary">Фото</label>
                <input class="form-control{{ $errors->has('photo') ? ' is-invalid' : '' }}" type="file" name="photo" id="organizationPhoto">
                @if ($errors->has('photo'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('photo') }}</strong>
                    </span>
                @endif
                <button type="submit" class="btn btn-primary my-2">Добавить</button>
            </form>
            @else
            У вас нет прав на создание образовательной организации.
            @endcan
        </div>
    </div>
</div>
@endsection