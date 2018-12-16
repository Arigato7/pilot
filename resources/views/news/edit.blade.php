@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1 mb-4">Редактирование новости</h1>
    <div class="card">
        <div class="card-body">
            <form id="create-news" action="{{ route('news.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="newsHeader" class="col-form-label text-secondary">Заголовок</label>
                <input type="text" name="header" class="form-control form-control-lg{{ $errors->has('header') ? ' is-invalid' : '' }}" id="newsHeader" placeholder="Заголовок новости" value="{{ $news->header }}">
                @if ($errors->has('header'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('header') }}</strong>
                    </span>
                @endif
                <label for="validatedCustomFile" class="col-form-label text-secondary">Изображение к новости</label>
                <div class="custom-file{{ $errors->has('image') ? ' is-invalid' : '' }}">
                    <input type="file" name="image" class="custom-file-input" id="validatedCustomFile">
                    <label class="custom-file-label" for="validatedCustomFile">Выберите файл</label>
                </div>
                @if ($errors->has('image'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                @endif
                <label for="newsDescription" class="col-form-label text-secondary">Содержимое</label>
                <textarea name="description" id="newsDescription" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" cols="30" rows="20" placeholder="Содержимое новости">{{ $news->description }}</textarea>
                @if ($errors->has('description'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
                <button class="btn btn-primary my-2" type="submit">Создать</button>
            </form>
        </div>
    </div>
</div>
@endsection