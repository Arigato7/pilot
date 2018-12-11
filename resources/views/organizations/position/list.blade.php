@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Должность
        </div>
        <div class="card-body p-0">
            <div class="list-group list-group-flush">
                <div class="list-group-item">
                    <form action="{{ route('positions.store') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="name" class="form-control">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-light">
                                    <i class="fa fa-2x fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @forelse ($positions as $position)
                <div class="list-group-item">
                    <div class="d-flex align-items-center justify-content-between">
                        {{ $position->name }}
                        <div class="btn-group">
                            <button class="btn btn-sm btn-light" data-toggle="tooltip" data-placement="left" title="Удалить" onclick="event.preventDefault(); document.getElementById('delete-position-{{ $position->id }}').submit()">
                                <span class="fa fa-2x fa-close"></span>
                            </button>
                            <button class="btn btn-sm btn-light" data-toggle="tooltip" data-placement="right" title="Изменить">
                                <span class="fa fa-2x fa-edit"></span>
                            </button>
                            <form action="{{ route('positions.delete', ['id'=>$position->id]) }}" id="delete-position-{{ $position->id }}" method="post" style="display: none;">
                                @csrf
                            </form>
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