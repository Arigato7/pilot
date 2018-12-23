@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1 mb-4">Список жалоб на материалы</h1>
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-sm table-borderless table-hover">
                <thead>
                    <tr>
                        <th scope="col">Материал</th>
                        <th scope="col">Пользователь</th>
                        <th scope="col">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($complaints as $complaint)
                    <tr>
                        <td>
                            <a href="/material/{{ $complaint->material_id }}">{{ $complaint->material_name }}</a>
                        </td>
                        <td>
                            <a href="/user/{{ $complaint->user_login }}">{{ $complaint->user_login }}</a>
                        </td>
                        <td>#</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">Пусто</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection