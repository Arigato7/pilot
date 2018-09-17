@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card course">
        <div class="card-header">
            {{ $course->name }}
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="h2">{{ $course->name }}</h2>
                <a href="#" class="btn btn-lg btn-primary">Записаться</a>
            </div>
            <div class="d-flex justify-content-between">
                <div class="col-6 text-right">
                    <div><b>Дата начала</b></div>
                    <div><b>Дата окончания</b></div>
                </div>
                <div class="col-6 text-left">
                    <div class="text-secondary">{{ $course->start_date }}</div>
                    <div class="text-secondary">{{ $course->end_date }}</div>
                </div>
            </div>
            <div class="text-secondary">
                {{ $course->description }}
            </div>
            <div class="pt-2 border-top">
                <i>Записаться на курс можно до </i>{{ $course->end_entry_date }}
            </div>
        </div>
    </div>
</div>
@endsection