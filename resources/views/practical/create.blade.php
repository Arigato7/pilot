@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Добавление практической работы
        </div>
        <div class="card-body">
            <form action="{{ route('practicalWorkStore') }}" method="post">
                @csrf
                <label for="practicalName" class="col-form-label text-secondary">Название практической работы</label>
                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="practicalName" placeholder="Введите название практической работы" aria-describedby="practicalNameHelpBlock">
                <small id="practicalNameHelpBlock" class="form-text text-muted">
                    Название не должно быть длиннее 255 символов
                </small>
                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
                <div class="form-row">
                    <div class="col-form-label col-6">
                        <label for="practicalSpecialty" class="col-form-label text-secondary">Специальность</label>
                        <select class="form-control{{ $errors->has('specialty') ? ' is-invalid' : '' }}" name="specialty" id="practicalSpecialty">
                            <option value="#" selected disabled>Выберите специальность</option>
                            @forelse($specialties as $specialty)
                            <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                            @empty
                            <option value="#" disabled>Пусто</option>
                            @endforelse
                        </select>
                        @if ($errors->has('specialty'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('specialty') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-form-label col-6">
                        <label for="practicalSubject" class="col-form-label text-secondary">Дисциплина</label>
                        <select class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject" id="practicalSubject">
                            <option value="#" selected disabled>Выберите дисциплину</option>
                            @forelse($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @empty
                            <option value="#" disabled>Пусто</option>
                            @endforelse
                        </select>
                        @if ($errors->has('subject'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('subject') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <label for="practicalResourse" class="col-form-label text-secondary">Ссылка на ресурс</label>
                <input type="text" class="form-control{{ $errors->has('resource') ? ' is-invalid' : '' }}" name="resource" id="practicalResourse" placeholder="Введите ссылку на ресурс" aria-describedby="practicalResourseHelpBlock">
                <small id="practicalResourseHelpBlock" class="form-text text-muted">
                    Ссылка должна быть URL-адресом
                </small>
                @if ($errors->has('resource'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('resource') }}</strong>
                    </span>
                @endif
                <label for="practicalDescription" class="col-form-label text-secondary">Описание</label>
                <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="practicalDescription" placeholder="Введите описание практической работы" cols="30" rows="10" aria-describedby="practicalDescriptionHelpBlock"></textarea>
                <small id="practicalDescriptionHelpBlock" class="form-text text-muted">
                    Описание не должно быть длиннее 2000 символов
                </small>
                @if ($errors->has('description'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
                <input type="hidden" name="date" value="{{ date( "Y-m-d H:i:s", strtotime("now")) }}">
                <button type="submit" class="btn btn-primary mt-2"><i class="fa fa-plus mr-2"></i>Добавить</button>
            </form>
        </div>
    </div>
</div>
@endsection