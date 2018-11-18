@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Создание новости
        </div>
        <div class="card-body">
            <form id="create-news" action="{{ route('news.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row align-items-center">
                    <label for="newsTheme" class="col-sm-3 col-form-label col-form-label-lg">Тема</label>
                    <div class="col-sm-9">
                        <input type="text" name="theme" class="form-control form-control-lg" id="newsTheme" placeholder="Тема новости">
                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <label for="newsHeader" class="col-sm-3 col-form-label col-form-label-lg">Заголовок</label>
                    <div class="col-sm-9">
                        <input type="text" name="header" class="form-control form-control-lg" id="newsHeader" placeholder="Заголовок новости">
                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <label for="newsDescription" class="col-sm-3 col-form-label col-form-label-lg">Краткое описание</label>
                    <div class="col-sm-9">
                        <textarea name="description" id="newsDescription" class="form-control form-control-lg" cols="30" rows="5" placeholder="Краткое описание новости"></textarea>
                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <label for="newsContent" class="col-sm-3 col-form-label col-form-label-lg">Содержимое</label>
                    <div class="col-sm-9">
                        <textarea name="content" id="newsContent" class="form-control form-control-lg" cols="30" rows="15" placeholder="Содержимое новости"></textarea>
                    </div>
                </div>
                {{-- <div class="mt-2 custom-file">
                    <input type="file" name="image" class="custom-file-input" id="validatedCustomFile" required>
                    <label class="custom-file-label" for="validatedCustomFile">Выберите файл</label>
                </div> --}}
                <button class="btn btn-primary my-2" type="submit">Создать</button>
            </form>
        </div>
    </div>
</div>
@endsection