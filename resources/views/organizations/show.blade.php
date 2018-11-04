@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card organization">
        <div class="card-header">
            <div class="row justify-content-between align-items-center px-3">
                Образовательная организация {{ $organization->name }}
                <div class="organization__panel text-right">
                    @can ('update-organization', $organization)
                    <a href="/organization/{{ $organization->id }}/edit" title="Редактировать"><i class="fa fa-2x fa-edit text-primary mr-2"></i></a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="organization__info px-3 w-75">
                <div class="row justify-content-between align-items-center py-3">
                    <div class="font-weight-bold">Название организации</div>
                    <div class="text-left col-6">{{ $organization->name }}</div>
                </div>
                <div class="row justify-content-between align-items-center py-3">
                    <div class="font-weight-bold">Сайт</div>
                    <div class="text-left col-6">{{ $organization->cite }}</div>
                </div>
                <div class="row justify-content-between align-items-center py-3">
                    <div class="font-weight-bold">Email</div>
                    <div class="text-left col-6">{{ $organization->email }}</div>
                </div>
                <div class="row justify-content-between align-items-center py-3">
                    <div class="font-weight-bold">Телефон</div>
                    <div class="text-left col-6">{{ $organization->phone }}</div>
                </div>
                <div class="row justify-content-between align-items-center py-3">
                    <div class="font-weight-bold">Адрес</div>
                    <div class="text-left col-6">{{ $organization->address }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="organization__users">
            <h3 class="h3 p-4">Пользователи</h3>
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
                            <a href="/user/{{ $user->login }}">{{ $user->name }}</a>
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