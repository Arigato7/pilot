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
                        @can('administrate', Auth::user())
                        <a href="{{ route('positions') }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                        @endcan
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
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        Образовательные организации
                        @can('administrate', Auth::user())
                        <a href="{{ route('organizations.create') }}" class="btn btn-primary"><i class="fa fa-plus mr-2"></i>Создать</a>
                        @endcan
                    </div>
                </div>
            </div>
            @forelse ($organizations as $organization)
            <div class="card mb-3">
                <div class="position-relative">
                    @if (! $organization->photo)
                    <img src="{{ asset('storage/organization.jpg') }}" alt="photo" class="card-img-bottom">
                    @else
                    <img src="{{ route('photos.organizations.show', ['name'=>$organization->photo]) }}" alt="photo" class="card-img-top">
                    @endif
                    <div class="card-img-overlay row align-items-end justify-content-between">
                        <div class="col">
                            <div class="btn-group">
                                @can('administrate', Auth::user())
                                <a href="{{ route('organizations.edit', ['id'=>$organization->id]) }}" class="btn btn-light"><i class="fa fa-pencil"></i></a>
                                @endcan
                            </div>
                        </div>
                        <div class="col text-right">
                            <div class="btn-group">
                                <div class="btn btn-light">
                                    <i class="fa fa-at mr-1"></i>
                                    {{ $organization->email }}
                                </div>
                                <div class="btn btn-light">
                                    <i class="fa fa-phone mr-1"></i>
                                    {{ $organization->phone }}
                                </div>
                                <div class="btn btn-light">
                                    <i class="fa fa-external-link mr-1"></i>
                                    {{ $organization->cite }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body pb-0">
                    <h5 class="card-title">
                        <a href="{{ route('organizations.show', ['id'=>$organization->id]) }}">
                            {{ $organization->shortname != null ? $organization->shortname : $organization->name }}
                        </a>
                    </h5>
                    <div class="card-text">
                        <p class="text-muted">{{ $organization->address }}</p>
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
@endsection