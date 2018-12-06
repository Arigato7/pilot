@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1">Курсы повышения квалификации</h1>
    <div class="d-flex justify-content-between">
        <div class="col-lg-4 pl-0">
            <div class="card subjects">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Типы курсов
                        @can ('administrate', Auth::user())
                        <a href="{{ route('courses.types') }}" class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="right" title="Изменить"><i class="fa fa-edit"></i></a>
                        @endcan
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($types as $type)
                        <div class="list-group-item subject">
                            <a href="#">{{ $type->name }}</a>
                        </div>
                        @empty
                        <div class="list-group-item text-center text-secondary">
                            Пусто
                        </div>
                        @endforelse
                        @if ($type->count() > 5)
                        <a href="#" class="btn btn-primary">Показать все</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 pr-0">
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
                                <div>
                                    @can('course-entry', $course)
                                        @if (date_create("now") <= date_create($course->end_entry_date))
                                        <a href="#" class="btn btn-lg btn-primary">Записаться</a>
                                        @else
                                            <div class="btn btn-lg btn-danger">Запись закрыта</div>
                                        @endif
                                    @else
                                        <div class="btn btn-lg btn-success">Вы записаны</div>
                                    @endcan
                                    @can ('administrate', Auth::user())
                                        <button type="button" class="btn btn-danger" onclick="event.preventDefault(); if (confirm('Вы уверены?')) { document.getElementById('delete-course-{{ $course->id }}').submit(); alert('Курс удален!'); }">
                                            <i class="fa fa-2x fa-close"></i>
                                        </button>
                                        <button type="button" class="btn btn-light">
                                            <i class="fa fa-2x fa-edit"></i>
                                        </button>
                                        <form action="{{ route('courses.delete', ['id'=>$course->id]) }}" id="delete-course-{{ $course->id }}" method="post" style="display: none;">
                                            @csrf
                                        </form>
                                    @endcan
                                </div>
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
    </div>
</div>
@endsection