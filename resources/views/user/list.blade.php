@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-header">
            Список пользователей
        </div>
        <div class="card-body p-0">
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
                            <a href="{{ route('users.show', ['login'=>$user->login]) }}">{{ $user->login }}</a>
                        </td>
                        <td>{{ $user->role->name }}</td>
                        <td>
                            <a href="{{ route('users.props.edit', ['id'=>$user->id]) }}" class="btn btn-primary">Изменить</a>
                            @if (Auth::user()->id !== $user->id)
                                <a href="#" class="btn btn-danger disabled" disabled>Удалить</a>
                            @endif
                        </td>
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
    <div class="card">
        <div class="card-header">
            Заявки на регистрацию
        </div>
        <div class="card-body p-0">
            <table class="table table-borderless table-hover">
                <thead>
                    <tr>
                        <th scope="col">ИД</th>
                        <th scope="col">Логин</th>
                        <th scope="col">Пароль</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Фамилия</th>
                        <th scope="col">Email</th>
                        <th scope="col">Телефон</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($applications as $application)
                    <tr>
                        <td>{{ $application->id }}</td>
                        <td>
                            {{ $application->login }}
                        </td>
                        <td>
                            <input id="app_pass" type="text" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="app_pass">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </td>
                        <td>{{ $application->name }}</td>
                        <td>{{ $application->lastname }}</td>
                        <td>{{ $application->email }}</td>
                        <td>{{ $application->phone }}</td>
                        <td>
                            <a href="#" class="btn btn-success" onclick="document.getElementById('application-pass').value = document.getElementById('app_pass').value; document.getElementById('accept-application-{{ $application->id }}').submit()">
                                Принять
                                <form id="accept-application-{{ $application->id }}" action="{{ route('application.accept', ['id'=>$application->id]) }}" method="post" style="display: none;">
                                    @csrf
                                    <input id="application-pass" type="text" name="password" style="display: none;">
                                </form>
                            </a>
                            <a href="#" class="btn btn-danger" onclick="document.getElementById('delete-application-{{ $application->id }}').submit()">
                                Удалить
                                <form id="delete-application-{{ $application->id }}" action="{{ route('application.delete', ['id'=>$application->id]) }}" method="post" style="display: none;">
                                    @csrf
                                </form>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">Пусто</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection