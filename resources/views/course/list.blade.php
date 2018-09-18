@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1">Курсы повышения квалификации</h1>
    <div class="card courses">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                Список курсов повышения квалификации
                @can ('administrate', Auth::user())
                <a href="{{ route('courseCreate') }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="right" title="Создать"><i class="fa fa-plus"></i></a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            @forelse($courses as $course)
            <div class="course">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="h3 mb-2">
                        <a href="/course/{{ $course->id }}">{{ $course->name }}</a>
                    </h3>
                    <a href="#" class="btn btn-lg btn-primary">Записаться</a>
                </div>
                <div class="row justify-content-between align-items-center">
                    <div class="col-6">
                        <div class="text-secondary">{{ $course->place }}</div>
                        <div class="text-secondary">Дата начала: {{ $course->start_date }}</div>
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
@endsection