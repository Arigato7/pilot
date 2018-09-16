@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Добавление курса</div>
        <div class="card-body">
            <form action="{{ route('courseStore') }}" method="post">
                @csrf
                <label for="courseName" class="col-form-label text-secondary">Название курса</label>
                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="courseName" placeholder="Введите название курса">
                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
                <div class="form-row">
                    <div class="col-form-label col-6">
                        <label for="courseStartDate" class="col-form-label text-secondary">Дата начала</label>
                        <input type="date" class="form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}" name="start_date" id="courseStartDate" placeholder="С">
                        @if ($errors->has('start_date'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('start_date') }}</strong>
                            </span>
                        @endif
                        <label for="courseStartTime" class="col-form-label text-secondary">Время начала</label>
                        <input type="time" class="form-control{{ $errors->has('start_time') ? ' is-invalid' : '' }}" name="start_time" id="courseStartTime" placeholder="С">
                        @if ($errors->has('start_time'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('start_time') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-form-label col-6">
                        <label for="courseEndDate" class="col-form-label text-secondary">Дата завершения</label>
                        <input type="date" class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}" name="end_date" id="courseEndDate" placeholder="По">
                        @if ($errors->has('end_date'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('end_date') }}</strong>
                            </span>
                        @endif
                        <label for="courseEndTime" class="col-form-label text-secondary">Время завершения</label>
                        <input type="time" class="form-control{{ $errors->has('end_time') ? ' is-invalid' : '' }}" name="end_time" id="courseEndTime" placeholder="С">
                        @if ($errors->has('end_time'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('end_time') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <label for="coursePlace" class="col-form-label text-secondary">Место проведения</label>
                <input type="text" class="form-control{{ $errors->has('place') ? ' is-invalid' : '' }}" name="place" id="coursePlace" placeholder="Введите место проведения курса">
                @if ($errors->has('place'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('place') }}</strong>
                    </span>
                @endif
                <label for="courseDescription" class="col-form-label text-secondary">Описание</label>
                <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="courseDescription" placeholder="Введите описание курса" cols="30" rows="10"></textarea>
                @if ($errors->has('description'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
                <button type="submit" class="btn btn-primary mt-2"><i class="fa fa-plus mr-2"></i>Добавить</button>
            </form>
        </div>
    </div>
</div>
@endsection