@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Жалобы на материалы</div>
        <div class="card-body">
            <table class="table table-borderless table-hover">
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
                        <td colspan="3">Пусто</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection