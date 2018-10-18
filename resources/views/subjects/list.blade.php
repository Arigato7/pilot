@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                Дисциплины
                <a href="#" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="right" title="Добавить"><i class="fa fa-plus"></i></a>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="list-group list-group-flush">
                @forelse ($subjects as $subject)
                    <div class="list-group-item">
                        <div class="d-flex align-items-center justify-content-between">
                            {{ $subject->name }}
                            <div>
                                <span class="fa fa-2x fa-close text-danger mr-2" data-toggle="tooltip" data-placement="left" title="Удалить"></span>
                                <span class="fa fa-2x fa-edit text-primary" data-toggle="tooltip" data-placement="right" title="Изменить"></span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="list-group-item">
                        Пусто
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection