@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1 mb-4">
        Дистанционное обучение
    </h1>
    <div class="d-flex justify-content-between">
        <div class="col-lg-4 pl-0">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="h4">Специальности</h4>
                @can ('administrate', Auth::user())
                <a href="{{ route('specialties') }}" class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="right" title="Изменить"><i class="fa fa-pencil"></i></a>
                @endcan
            </div>
            <div class="card specialties mb-4">
                <div class="card-body p-0">
                    <div class="list-group">
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
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="h4">Дисциплины</h4>
                @can ('administrate', Auth::user())
                <a href="{{ route('subjects') }}" class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="right" title="Изменить"><i class="fa fa-pencil"></i></a>
                @endcan
            </div>
            <div class="card subjects">
                <div class="card-body p-0">
                    <div class="list-group">
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
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="h4">Практические работы</h4>
                @can ('administrate', Auth::user())
                <a href="{{ route('practicals.create') }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="right" title="Создать">
                    <i class="fa fa-plus"></i> Создать
                </a>
                @endcan
            </div>
            @forelse ($practicals as $practical)
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="h3 mb-2">
                            <a href="{{ route('practicals.show', ['id'=>$practical->id]) }}">{{ $practical->name }}</a>
                        </h3>
                        <a href="{{ route('practicals.show', ['id'=>$practical->id]) }}" class="btn btn-lg btn-primary">Открыть</a>
                    </div>
                    <div class="row justify-content-between align-items-center">
                        <div class="col-6">
                            <div class="text-secondary"></div>
                        </div>
                        <div class="col-6 text-right">
                            <div class="text-secondary">
                                {{ date( "d.m.Y в H:i", strtotime($practical->date)) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="card">
                <div class="card-body">
                    <div class="text-center text-secondary py-5">
                        <div class="h3">
                            <i class="fa fa-2x fa-info"></i>
                        </div>
                        <div class="h4 mb-3">
                            Практических работ не найдено!
                        </div>
                        @can ('administrate', Auth::user())
                        <a href="{{ route('practicals.create') }}" class="btn btn-primary">
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