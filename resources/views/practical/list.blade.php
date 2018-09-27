@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1 mb-4">
        Дистанционное обучение
    </h1>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                Практические работы
                @can ('administrate', Auth::user())
                <a href="{{ route('practicalWorkCreate') }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="right" title="Создать"><i class="fa fa-plus"></i></a>
                @endcan
            </div>
        </div>
        <div class="card-body"></div>
    </div>
</div>
@endsection