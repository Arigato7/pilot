@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1 mb-4">Редактирование специальностей</h1>
    <div class="mb-4">
        <form action="{{ route('specialties.store') }}" method="post">
            @csrf
            <div class="input-group mb-4">
                <select name="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" required>
                    <option value="#" selected disabled>Выберите тип специальности</option>
                    @forelse ($specialtyTypes as $specialtyType)
                    <option value="{{ $specialtyType->id }}">{{ $specialtyType->name }}</option>   
                    @empty
                    <option value="#">Пусто</option>
                    @endforelse
                </select>
                @if ($errors->has('type'))
                    <span class="invalid-tooltip">
                        <strong>{{ $errors->first('type') }}</strong>
                    </span>
                @endif
                <div class="input-group-append">
                    <a href="#" class="btn btn-light">
                        <i class="fa fa-pencil"></i>
                    </a>
                </div>
            </div>
            <div class="input-group">
                <label for="specialty-name" class="col-10 pl-0">
                    <input id="specialty-name" type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Название специальности" {{ old('name') }}>
                    @if ($errors->has('name'))
                        <span class="invalid-tooltip">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </label>
                <label for="specialty-code" class="col-2 pr-0">
                    <input id="specialty-code" type="text" name="code" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" placeholder="Код" value="{{ old('code') }}">
                    @if ($errors->has('code'))
                        <span class="invalid-tooltip">
                            <strong>{{ $errors->first('code') }}</strong>
                        </span>
                    @endif
                </label>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-light">
                    <i class="fa fa-plus mr-2"></i> Добавить
                </button>
            </div>
        </form>
    </div>
    <div class="card">
        <div class="card-body p-0">
            <div class="list-group">
                @forelse ($specialties as $specialty)
                    <div class="list-group-item">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                {{ $specialty->name }} <span class="text-muted">{{ $specialty->code }}</span>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-light" data-toggle="tooltip" data-placement="left" title="Удалить" onclick="event.preventDefault(); document.getElementById('delete-specialty-{{ $specialty->id }}').submit()">
                                    <span class="fa fa-2x fa-close"></span>
                                </button>
                                <button class="btn btn-sm btn-light" data-toggle="tooltip" data-placement="right" title="Изменить">
                                    <span class="fa fa-2x fa-pencil"></span>
                                </button>
                                <form action="{{ route('specialties.delete', ['id'=>$specialty->id]) }}" id="delete-specialty-{{ $specialty->id }}" method="post" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="list-gruop-item">
                        Пусто
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection