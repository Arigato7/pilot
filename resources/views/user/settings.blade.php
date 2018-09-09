@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card settings">
        <div class="card-header">
            Настройки
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Редактировать профиль</a>
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Удаленные материалы</a>
                </div>
                <div class="tab-content col-9 pr-0" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="settings__change">
                            <div class="settings__view">
                                <form action="/user/{{ Auth::user()->login }}/change" method="post" enctype="multipart/form-data">
                                @csrf
                                <label for="userName" class="col-form-label text-secondary">Изменить имя</label>
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="userName" placeholder="Ваше имя" value="{{ Auth::user()->userInfo->name }}">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                <label for="userLastname" class="col-form-label text-secondary">Изменить фамилию</label>
                                <input type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" id="userLastname" placeholder="Ваша фамилия" value="{{ Auth::user()->userInfo->lastname }}">
                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                                <label for="userMiddlename" class="col-form-label text-secondary">Изменить отчество</label>
                                <input type="text" class="form-control{{ $errors->has('middlename') ? ' is-invalid' : '' }}" name="middlename" id="userMiddlename" placeholder="Ваше отчество" value="{{ Auth::user()->userInfo->middlename }}">
                                @if ($errors->has('middlename'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('middlename') }}</strong>
                                    </span>
                                @endif
                                <label for="userEmail" class="col-form-label text-secondary">Изменить email</label>
                                <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="userEmail" placeholder="Ваш email" value="{{ Auth::user()->userInfo->email }}">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <label for="userPosition" class="col-form-label text-secondary">Изменить должность</label>
                                <select name="position" id="userPosition" class="form-control">
                                    @forelse($positions as $position)
                                    <option value="{{ $position->id }}" {{ $position->id === Auth::user()->userInfo->position->id ? 'selected' : '' }}>{{ $position->name }}</option>
                                    @empty
                                    <option value="#" selected disabled>Пусто</option>
                                    @endforelse
                                </select>
                                <label for="userPhone" class="col-form-label text-secondary">Изменить телефон</label>
                                <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" id="userPhone" placeholder="Ваш телефон" value="{{ Auth::user()->userInfo->phone }}">
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                                <label for="userPhoto" class="col-form-label text-secondary">Фото</label>
                                <input type="file" name="photo" id="userPhoto" class="form-control{{ $errors->has('photo') ? ' is-invalid' : '' }}">
                                @if ($errors->has('photo'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif
                                <label for="userEducationOrganization" class="col-form-label text-secondary">Образовательная организация</label>
                                <select name="educationOrganization" id="userEducationOrganization" class="form-control">
                                    @forelse($educationOrganizations as $educationOrganization)
                                    <option value="{{ $educationOrganization->id }}" {{ $educationOrganization->id === Auth::user()->userInfo->educationOrganization->id ? 'selected' : '' }}>{{ $educationOrganization->name }}</option>
                                    @empty
                                    <option value="#" selected disabled>Пусто</option>
                                    @endforelse
                                </select>
                                <label for="userAbout" class="col-form-label text-secondary">О себе</label>
                                <textarea name="about" id="userAbout" cols="30" rows="5" class="form-control">{{ Auth::user()->userInfo->about }}</textarea>
                                <button class="btn btn-primary my-2" type="submit">Сохранить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        @forelse ($materials as $material)
                        <div class="material">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="material__name">
                                    <a href="#">{{ $material->name }}</a>
                                    <div class="text-secondary">
                                        Удален {{ $material->deleted_at }} пользователем {{ $material->who_deleted }}
                                    </div>
                                </div>
                                <div class="material__actions">
                                    <a href="#" class="mr-2" 
                                    onclick="event.preventDefault();
                                        document.getElementById('restore-material').submit();">
                                        <i class="fa fa-2x fa-undo text-success" data-toggle="tooltip" data-placement="top" title="Восстановить"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fa fa-2x fa-close text-danger" data-toggle="tooltip" data-placement="right" title="Удалить"></i>
                                    </a>
                                    <form id="restore-material" action="/material/{{ $material->id }}/restore" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-secondary text-center py-4">Пусто</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection