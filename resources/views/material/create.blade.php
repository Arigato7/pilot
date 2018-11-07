<<<<<<< HEAD
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card create-material">
        <div class="card-header">Добавить материал</div>
        <div class="card-body">
            <form action="{{ route('materialSave') }}" method="POST" name="createMaterial" enctype="multipart/form-data">
                @csrf
                <label for="materialName" class="col-form-label text-secondary">Название материала</label>
                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="materialName" placeholder="Введите название материала">
                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
                <div class="form-row">
                    <div class="col-form-label col-4">
                        <label for="materialType" class="col-form-label text-secondary">Тип матерала</label>
                        <select class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" id="materialType">
                            <option value="#" selected disabled>Выберите тип материала</option>
                            @forelse($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @empty
                            <option value="#" disabled>Пусто</option>
                            @endforelse
                        </select>
                        @if ($errors->has('type'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('type') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-form-label col-4">
                        <label for="materialSpecialty" class="col-form-label text-secondary">Специальность</label>
                        <select class="form-control{{ $errors->has('specialty') ? ' is-invalid' : '' }}" name="specialty" id="materialSpecialty">
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
                    <div class="col-form-label col-4">
                        <label for="materialSubject" class="col-form-label text-secondary">Дисциплина</label>
                        <select class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject" id="materialSubject">
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
                <label for="materialDescription" class="col-form-label text-secondary">Краткое описание</label>
                <textarea name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" id="materialDescription" cols="30" rows="10" placeholder="Введите краткое описание"></textarea>
                @if ($errors->has('description'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
                <div class="mt-2 custom-file{{ $errors->has('content') ? ' is-invalid' : '' }}">
                    <input type="file" name="content" class="custom-file-input" id="validatedCustomFile" required>
                    <label class="custom-file-label" for="validatedCustomFile">Выберите файл</label>
                    @if ($errors->has('content'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('content') }}</strong>
                        </span>
                    @endif
                </div>
                <button class="btn btn-primary my-2" type="submit">Создать</button>
            </form>
        </div>
    </div>
</div> 
=======
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card create-material">
        <div class="card-header">Добавить материал</div>
        <div class="card-body">
            <form action="{{ route('materials.store') }}" method="POST" name="createMaterial" enctype="multipart/form-data">
                @csrf
                <label for="materialName" class="col-form-label text-secondary">Название материала</label>
                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="materialName" placeholder="Введите название материала">
                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
                <div class="form-row">
                    <div class="col-form-label col-4">
                        <label for="materialType" class="col-form-label text-secondary">Тип матерала</label>
                        <select class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" id="materialType">
                            <option value="#" selected disabled>Выберите тип материала</option>
                            @forelse($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @empty
                            <option value="#" disabled>Пусто</option>
                            @endforelse
                        </select>
                        @if ($errors->has('type'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('type') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-form-label col-4">
                        <label for="materialSpecialty" class="col-form-label text-secondary">Специальность</label>
                        <select class="form-control{{ $errors->has('specialty') ? ' is-invalid' : '' }}" name="specialty" id="materialSpecialty">
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
                    <div class="col-form-label col-4">
                        <label for="materialSubject" class="col-form-label text-secondary">Дисциплина</label>
                        <select class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject" id="materialSubject">
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
                <label for="materialDescription" class="col-form-label text-secondary">Краткое описание</label>
                <textarea name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" id="materialDescription" cols="30" rows="10" placeholder="Введите краткое описание"></textarea>
                @if ($errors->has('description'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
                <div class="mt-2 custom-file{{ $errors->has('content') ? ' is-invalid' : '' }}">
                    <input type="file" name="content" class="custom-file-input" id="validatedCustomFile" required>
                    <label class="custom-file-label" for="validatedCustomFile">Выберите файл</label>
                    @if ($errors->has('content'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('content') }}</strong>
                        </span>
                    @endif
                </div>
                <button class="btn btn-primary my-2" type="submit">Создать</button>
            </form>
        </div>
    </div>
</div> 
>>>>>>> test
@endsection