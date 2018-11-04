@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1">Новости</h1>
    <div class="card news">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                Список новостей
                @auth
                <a href="{{ route('newsCreate') }}" class="btn btn-primary btn-sm" title="Создать"><i class="fa fa-plus mr-2"></i>Создать</a>
                @else
                <div>Чтобы добавить новости <a href="{{ route('login') }}">войдите</a> или <a href="{{ route('register') }}">зарегистрируйтесь</a></div>
                @endauth
            </div>
        </div>
        <div class="card-body">
            <h2 class="h2 mb-4">Последние добавленные</h2>
            @forelse($newNews as $item)
            <div class="news__item">
                <div class="d-flex justify-content-between">
                    <div class="col-lg-5">
                        <a href="#" class="material__link">{{ $item->header }}</a>
                        <p class="material__author">
                            <a href="/user/{{ $item->user_login }}" class="text-secondary">{{ $item->user_name }}</a>
                        </p>
                    </div>
                    <p class="material__date text-secondary">{{ $item->date }}</p>
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