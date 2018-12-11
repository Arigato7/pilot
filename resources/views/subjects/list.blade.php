@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                Дисциплины
            </div>
        </div>
        <div class="card-body p-0">
            <div class="list-group list-group-flush">
                <div class="list-group-item">
                    <form action="{{ route('subjects.store') }}" method="post">
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
                @forelse ($subjects as $subject)
                    <div class="list-group-item">
                        <div class="d-flex align-items-center justify-content-between">
                            {{ $subject->name }}
                            <div class="btn-group">
                                <button class="btn btn-sm btn-light" data-toggle="tooltip" data-placement="left" title="Удалить" onclick="event.preventDefault(); document.getElementById('delete-subject-{{ $subject->id }}').submit()">
                                    <span class="fa fa-2x fa-close"></span>
                                </button>
                                <button class="btn btn-sm btn-light" data-toggle="tooltip" data-placement="right" title="Изменить">
                                    <span class="fa fa-2x fa-edit"></span>
                                </button>
                                <form action="{{ route('subjects.delete', ['id'=>$subject->id]) }}" id="delete-subject-{{ $subject->id }}" method="post" style="display: none;">
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