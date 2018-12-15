@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1 mb-4">Редактирование типов курсов повышения квалификации</h1>
    <div class="card course-types">
        <div class="card-header">
            Список типов курсов
        </div>
        <div class="card-body p-0">
            <div class="list-group list-group-flush">
                <div class="list-group-item">
                    <form action="{{ route('courses.types.store') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="name" class="form-control" placeholder="Название типа курса">
                            <button type="submit" class="btn btn-light">
                                <i class="fa fa-2x fa-plus"></i>
                            </button>
                        </div>
                    </form>
                </div>
                @forelse($types as $type)
                <div class="list-group-item subject">
                    <div class="d-flex justify-content-between">
                        {{ $type->name }}
                        <div class="btn-group">
                            <button class="btn btn-sm btn-light" data-toggle="tooltip" data-placement="left" title="Удалить" onclick="event.preventDefault(); document.getElementById('delete-course-type-{{ $type->id }}').submit()">
                                <span class="fa fa-2x fa-close"></span>
                            </button>
                            <button class="btn btn-sm btn-light" data-toggle="tooltip" data-placement="right" title="Изменить">
                                <span class="fa fa-2x fa-pencil"></span>
                            </button>
                            <form action="{{ route('courses.types.delete', ['id'=>$type->id]) }}" id="delete-course-type-{{ $type->id }}" method="post" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
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
@endsection