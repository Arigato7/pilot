@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1">Курсы повышения квалификации</h1>
    <div class="card courses">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                Список курсов повышения квалификации
                @can ('administrate', Auth::user())
                <a href="{{ route('courses.create') }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="right" title="Создать"><i class="fa fa-plus"></i></a>
                @endcan
            </div>
        </div>
        <div class="card-body p-0">
            <div class="list-group list-group-flush">
                @forelse($courses as $course)
                <div class="list-group-item course">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="h3 mb-2">
                            <a href="{{ route('courses.show', ['id'=>$course->id]) }}">{{ $course->name }}</a>
                        </h3>
                        @can('course-entry', $course)
                            @if (date_create("now") <= date_create($course->end_entry_date))
                            <a href="#" class="btn btn-lg btn-primary">Записаться</a>
                            @else
                                <div class="btn btn-lg btn-danger">Запись закрыта</div>
                            @endif
                        @else
                            <div class="btn btn-lg btn-success">Вы записаны</div>
                        @endcan
                    </div>
                    <div class="row justify-content-between align-items-center">
                        <div class="col-6">
                            <div class="text-secondary">{{ $course->place }}</div>
                            <div class="text-secondary">Дата начала: {{ date( "d.m.Y в H:i", strtotime($course->start_date)) }}</div>
                        </div>
                        <div class="col-6 text-right">
                            <div class="text-secondary">Количество часов: {{ $course->duration }} ч.</div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center text-secondary py-5">
                    <p class="h3">Пусто</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection