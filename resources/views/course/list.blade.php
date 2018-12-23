@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1 mb-4">Курсы повышения квалификации</h1>
    <div class="d-flex justify-content-between">
        <div class="col-lg-4 pl-0">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="h4">Типы курсов</h4>
                @can ('administrate', Auth::user())
                <a href="{{ route('courses.types') }}" class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="right" title="Изменить"><i class="fa fa-pencil"></i></a>
                @endcan
            </div>
            <div class="card subjects">
                <div class="card-body p-0">
                    <div class="list-group">
                        @forelse($types as $type)
                        <div class="list-group-item subject">
                            <a href="#">
                                <i class="fa fa-book"></i> {{ $type->name }}
                            </a>
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
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="h4">Список курсов повышения квалификации</h4>
                @can ('administrate', Auth::user())
                <a href="{{ route('courses.create') }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="right" title="Создать"><i class="fa fa-plus mr-1"></i> Создать</a>
                @endcan
            </div>
            @forelse($courses as $course)
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="h3 mb-2">
                            <a href="{{ route('courses.show', ['id'=>$course->id]) }}">{{ $course->name }}</a>
                        </h3>
                        <div>
                            <div class="btn-group">
                            @can('course-entry', $course)
                                @if (date_create("now") <= date_create($course->end_entry_date))
                                <a href="#" class="btn btn-lg btn-primary" onclick="event.preventDefault();
                                document.getElementById('entry-course-{{ $course->id }}').submit();">Записаться</a>
                                <form id="entry-course-{{ $course->id }}" action="{{ route('courses.enroll', ['id'=>$course->id]) }}" method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="date" value="{{ date( "Y-m-d H:i:s", strtotime("now")) }}">
                                </form>
                                @else
                                    <div class="btn btn-danger">Запись закрыта</div>
                                @endif
                            @else
                                <button class="btn btn-light" onclick="event.preventDefault(); if (confirm('Вы уверены?')) { document.getElementById('cancel-course-{{ $course->id }}').submit(); alert('Вы отписались от курса {{ $course->name }}!'); }">Отписаться</button>
                                <form action="{{ route('courses.cancel', ['id'=>$course->id]) }}" id="cancel-course-{{ $course->id }}" method="post" style="display: none;">
                                    @csrf
                                </form>
                            @endcan
                            @can ('administrate', Auth::user())
                                <button type="button" class="btn btn-light" onclick="event.preventDefault(); if (confirm('Вы уверены?')) { document.getElementById('delete-course-{{ $course->id }}').submit(); alert('Курс удален!'); }">
                                    <i class="fa fa-close"></i>
                                </button>
                                <button type="button" class="btn btn-light">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <form action="{{ route('courses.delete', ['id'=>$course->id]) }}" id="delete-course-{{ $course->id }}" method="post" style="display: none;">
                                    @csrf
                                </form>
                            @endcan
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-between align-items-center">
                        <div class="col-6">
                            <div class="text-secondary">
                                Место проведения: {{ $course->place }}
                            </div>
                            <div class="text-secondary">Дата начала: {{ date( "d.m.Y в H:i", strtotime($course->start_date)) }}</div>
                        </div>
                        <div class="col-6 text-right">
                            <div class="text-secondary">Количество часов: {{ $course->duration }} ч.</div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="card">
                <div class="card-body pb-0">
                    <div class="text-center text-secondary py-5">
                        <div class="h3">
                            <i class="fa fa-2x fa-info"></i>
                        </div>
                        <div class="h4 mb-3">
                            Курсов не найдено!
                        </div>
                        @can ('administrate', Auth::user())
                        <a href="{{ route('courses.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus mr-2"></i>Создать
                        </a>
                        @endcan
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection