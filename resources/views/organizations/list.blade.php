@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1 mb-4">Образовательные организации</h1>
    <div class="d-flex justify-content-between">
        <div class="col-3 pl-0">
            <div class="card positions">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Должности
                        <a href="{{ route('positions') }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                @forelse ($positions as $position)
                    <li class="list-group-item">
                        {{ $position->name }}
                    </li>
                @empty
                    <li class="p-2">
                        <div class="text-center">Пусто</div>
                    </li>
                @endforelse
                </ul>
            </div>
        </div>
        <div class="col-9 pr-0">
            <div class="card organizations">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Образовательные организации
                        @can('administrate', Auth::user())
                        <a href="{{ route('organizations.create') }}" class="btn btn-primary"><i class="fa fa-plus mr-2"></i>Создать</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse ($organizations as $organization)
                        <div class="list-group-item organization">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="organization__name col-lg-6">
                                    <a href="{{ route('organizations.show', ['id'=>$organization->id]) }}">{{ $organization->shortname }}</a>
                                </div>
                                <div class="organization__peoples text-right col">
                                    {{ $organization->users->count() }}
                                </div>
                                <div class="btn-group organization__panel text-right col-lg-4">
                                    @can ('update-organization', $organization)
                                    <a href="{{ route('organizations.edit', ['id'=>$organization->id]) }}" title="Редактировать" class="btn btn-primary"><i class="fa fa-edit mr-2"></i>Редактировать</a>
                                    @endcan
                                    @can ('delete-organization', $organization)
                                    <a href="#" class="btn btn-light" title="Удалить">
                                        <i class="fa fa-close"></i>
                                        <form action="{{ route('organizations.delete', ['id'=>$organization->id]) }}" method="post" style="display: none;">
                                            @csrf
                                        </form>
                                    </a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center text-secondary py-5">
                            <p class="h3">Пусто</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection