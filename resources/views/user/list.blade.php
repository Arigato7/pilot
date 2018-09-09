@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Список пользователей
        </div>
        <div class="card-body">
            <table class="table table-borderless table-hover">
                <thead>
                    <tr>
                        <th scope="col">ИД</th>
                        <th scope="col">Логин</th>
                        <th scope="col">Роль</th>
                        <th scope="col">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            <a href="/user/{{ $user->login }}">{{ $user->login }}</a>
                        </td>
                        <td>{{ $user->role->name }}</td>
                        <td>test</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">Пусто</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection