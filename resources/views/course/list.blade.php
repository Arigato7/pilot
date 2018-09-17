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
                <h3 class="h3 mb-2"><a href="/course/{{ $course->id }}">{{ $course->name }}</a></h3>
                <div class="flex justify-content-between">
                    <div class="text-secondary col-6">{{ $course->place }}</div>
                    <div class="text-secondary col-6">Количество часов: {{ $course->place }} ч.</div>
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