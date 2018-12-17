@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1 mb-4">Редактирование типов материалов</h1>
    <div class="mb-4">
        <form action="{{ route('materials.types.store') }}" method="post">
            @csrf
            <div class="input-group">
                <input type="text" name="name" class="form-control" placeholder="Название типа материала">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-light">
                        <i class="fa fa-2x fa-plus"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="card">
        <div class="card-body p-0">
            <div class="list-group list-group-flush">
                @forelse ($types as $type)
                    <div class="list-group-item">
                        <div class="d-flex align-items-center justify-content-between">
                            {{ $type->name }}
                            <div class="btn-group">
                                <button class="btn btn-sm btn-light" data-toggle="tooltip" data-placement="left" title="Удалить" onclick="event.preventDefault(); document.getElementById('delete-type-{{ $type->id }}').submit()">
                                    <span class="fa fa-2x fa-close"></span>
                                </button>
                                <button class="btn btn-sm btn-light" data-toggle="tooltip" data-placement="right" title="Изменить">
                                    <span class="fa fa-2x fa-pencil"></span>
                                </button>
                                <form action="{{ route('materials.types.delete', ['id'=>$type->id]) }}" id="delete-type-{{ $type->id }}" method="post" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="list-gruop-item">
                        Пусто
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection