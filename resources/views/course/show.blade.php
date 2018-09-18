@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card course">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                {{ $course->name }}
                <div class="text-secondary">Место проведения: {{ $course->place }}</div>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="h2">
                        {{ $course->name }}
                    </h2>
                    <div class="text-secondary">Количество часов: {{ $course->duration }} ч.</div>
                </div>
                <div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between">
                            <div class="col-7 text-right">
                                <div><b>Дата начала</b></div>
                                <div><b>Дата окончания</b></div>
                            </div>
                            <div class="col-7 text-left">
                                <div class="text-secondary">{{ date( "d.m.Y с H:i", strtotime($course->start_date)) }}</div>
                                <div class="text-secondary">{{ date( "d.m.Y до H:i", strtotime($course->end_date)) }}</div>
                            </div>
                        </div>
                        <div class="ml-5">
                            @if ($date_diff->invert == 1)
                            <a href="#" class="btn btn-lg btn-primary">Записаться</a>
                            @else
                                <div class="btn btn-lg btn-danger">Запись зыкрыта</div>
                            @endif
                        </div>
                    </div>
                    @if ($date_diff->invert == 1)
                        <div class="text-right">Записаться можно до {{ date( "d.m.Y", strtotime($course->end_entry_date)) }}</div>
                    @else
                        <div class="text-right">Запись на курс завершена</div>
                    @endif
                </div>
            </div>
            <div class="py-5">
                {{ $course->description }}
            </div>
        </div>
    </div>
</div>
@endsection