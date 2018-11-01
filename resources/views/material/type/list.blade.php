@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                Типы материалов
                <a href="#" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="right" title="Добавить"><i class="fa fa-plus"></i></a>
            </div>
        </div>
        <div class="card-body p-0">
            <div id="materialTypes">
                <material-types></material-types>
            </div>
        </div>
    </div>
</div>
@endsection