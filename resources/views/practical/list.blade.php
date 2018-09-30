@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1 mb-4">
        Дистанционное обучение
    </h1>
    <div class="d-flex justify-content-between">
        <div class="col-lg-4 pl-0">
            <div class="card specialties mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Специальности
                        @can ('administrate', Auth::user())
                        <a href="{{ route('specialties') }}" class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="right" title="Изменить"><i class="fa fa-edit"></i></a>
                        @endcan
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($specialties as $specialty)
                        <div class="list-group-item specialty">
                            <div class="d-flex justify-content-between">
                                <a href="#" class="d-block">{{ $specialty->name }}</a>
                                <div class="text-secondary">{{ $specialty->code }}</div>
                            </div>
                        </div>
                        @empty
                        <div class="list-group-item text-center text-secondary">
                            Пусто
                        </div>
                        @endforelse
                        @if ($specialties->count() > 5)
                        <a href="#" class="btn btn-primary">Показать все</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card subjects">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Дисциплины
                        @can ('administrate', Auth::user())
                        <a href="{{ route('subjects') }}" class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="right" title="Изменить"><i class="fa fa-edit"></i></a>
                        @endcan
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($subjects as $subject)
                        <div class="list-group-item subject">
                            <a href="#">{{ $subject->name }}</a>
                        </div>
                        @empty
                        <div class="list-group-item text-center text-secondary">
                            Пусто
                        </div>
                        @endforelse
                        @if ($subjects->count() > 5)
                        <a href="#" class="btn btn-primary">Показать все</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 pr-0">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Практические работы
                        @can ('administrate', Auth::user())
                        <a href="{{ route('practicalWorkCreate') }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="right" title="Создать"><i class="fa fa-plus"></i></a>
                        @endcan
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse ($practicals as $practical)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="h3 mb-2">
                                        <a href="/practical-work/{{ $practical->id }}">{{ $practical->name }}</a>
                                    </h3>
                                    <a href="/practical-work/{{ $practical->id }}" class="btn btn-lg btn-primary">Открыть</a>
                                </div>
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-6">
                                        <div class="text-secondary">text</div>
                                    </div>
                                    <div class="col-6 text-right">
                                        <div class="text-secondary">
                                            {{ date( "d.m.Y в H:i", strtotime($practical->date)) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        <div class="list-group-item text-center text-secondary py-5">
                            <p class="h3">Пусто</p>
                        </div>
                        @endforelse
                        @if ($practicals->count() > 5)
                        <a href="#" class="btn btn-primary">Показать все</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection