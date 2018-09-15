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
        <div class="card-body"></div>
    </div>
</div>
@endsection