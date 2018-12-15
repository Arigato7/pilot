@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card organization">
        @if (! $organization->photo)
        <img src="{{ asset('storage/organization.jpg') }}" alt="photo" class="w-100">
        @else
        <img src="{{ asset('storage/organization/' . $organization->photo) }}" alt="photo" class="w-100">
        @endif
        <div class="card-img-overlay">
            <div class="row justify-content-between align-items-center px-3">
                <div></div>
                <div class="organization__panel text-right">
                    @can ('update-organization', $organization)
                    <a href="{{ route('organizations.edit', ['id'=>$organization->id]) }}" class="btn btn-light" title="Редактировать"><i class="fa fa-pencil"></i></a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card-body pb-0">
            <h2 class="h2">{{ $organization->name }}</h2>
            <div class="card-text">
                <p class="text-muted">{{ $organization->address }}</p>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between mt-3">
        <div class="col-3 pl-0">
            <div class="card">
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <i class="fa fa-at mr-2"></i>{{ $organization->email }}
                        </div>
                        <div class="list-group-item">
                            <i class="fa fa-phone mr-2"></i>{{ $organization->phone }}
                        </div>
                        <div class="list-group-item">
                            <i class="fa fa-external-link mr-2"></i>{{ $organization->cite }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9 pr-0">
            <div class="card">
                <div class="card-body">
                    <div class="card-text">
                        {{ $organization->description != null ? $organization->description : '' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="organization__users">
            <h3 class="h3 p-4">Пользователи - {{ $users->count() }}</h3>
            <table class="table table-borderless table-hover">
                <thead>
                    <tr>
                        <th scope="col">Имя</th>
                        <th scope="col">Должность</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>
                            <a href="{{ route('users.show', ['login'=>$user->login]) }}">{{ $user->name }}</a>
                        </td>
                        <td>{{ $user->position }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2">Пусто</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection