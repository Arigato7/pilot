@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <div class="col-4">
            <div class="card positions">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Должности
                        <a href="#" class="btn btn-primary"><i class="fa fa-plus mr-2"></i>Создать</a>
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
        <div class="col-8">
            <div class="card organizations">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Образовательные организации
                        <a href="{{ route('createOrganization') }}" class="btn btn-primary"><i class="fa fa-plus mr-2"></i>Создать</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="font-weight-bold text-left col-lg-7">Название организации</div>
                        <div class="font-weight-bold text-center col-lg-3">Количество человек</div>
                        <div class="font-weight-bold col-lg-2">Действия</div>
                    </div>
                    @forelse ($organizations as $organization)
                    <div class="organization">
                        <div class="d-flex justify-content-between align-items-center py-4">
                            <div class="organization__name col-lg-6">
                                <a href="/organization/{{ $organization->id }}">{{ $organization->name }}</a>
                            </div>
                            <div class="organization__peoples text-right col-lg-3">
                                {{ $organization->users->count() }}
                            </div>
                            <div class="organization__panel text-right col-lg-3">
                                @can ('update-organization', $organization)
                                <a href="/organization/{{ $organization->id }}/edit" title="Редактировать"><i class="fa fa-2x fa-edit text-primary mr-2"></i></a>
                                @endcan
                                @can ('delete-organization', $organization)
                                <a href="/organization/{{ $organization->id }}/del" title="Удалить"><i class="fa fa-2x fa-close text-danger"></i></a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    @empty
                    Empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection