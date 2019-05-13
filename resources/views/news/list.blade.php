@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1 mb-4">Новости</h1>
    <div class="d-flex justify-content-between">
        <div class="col-3 pl-0">
            <div class="card">
                <div class="card-header">Новости</div>
                <div class="card-body">Для начала, создайте новость</div>
            </div>
        </div>
        <div class="col-9 pr-0">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="h4">Список новостей</h4>
                @auth
                <a href="{{ route('news.create') }}" class="btn btn-primary btn-sm" title="Создать"><i class="fa fa-plus mr-2"></i>Создать</a>
                @else
                <div>Чтобы добавить новости <a href="{{ route('login') }}">войдите</a> или <a href="{{ route('register') }}">зарегистрируйтесь</a></div>
                @endauth
            </div>
            @forelse($news as $item)
            <div class="card mb-3">
                <div class="position-relative">
                    @if ($item->image)
                    <img src="{{ asset('storage/images/' . $item->image) }}" alt="photo" class="card-img-bottom">
                    @endif
                    <div class="card-img-overlay row justify-content-between">
                        <div class="col">
                            <div class="btn-group">
                                @can('administrate', Auth::user())
                                <a href="{{ route('news.edit', ['id'=>$item->id]) }}" class="btn btn-light"><i class="fa fa-pencil"></i></a>
                                @endcan
                            </div>
                        </div>
                        <div class="col text-right">
                            <div class="btn-group">
                                <a href="{{ route('users.show', ['login'=>$item->user_login]) }}" class="btn btn-light">
                                    <i class="fa fa-user-circle mr-1"></i>
                                    {{ $item->user_name . ' ' . $item->user_lastname }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body pb-0">
                    <h1 class="card-title">
                        <a href="{{ route('news.show', ['id'=>$item->id]) }}">
                            {{ $item->header }}
                        </a>
                    </h1>
                    <div class="card-text">
                        <p class="text-muted">{{ date( "d.m.Y в H:i", strtotime($item->date)) }}</p>
                    </div>
                    <div class="py-2">
                        <p class="text-muted">
                            {{ str_limit($item->description, 100) }}
                        </p>
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