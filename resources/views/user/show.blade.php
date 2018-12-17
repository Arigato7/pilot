@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1 mb-4">Личный кабинет</h1>
    <div class="d-flex justify-content-between">
        <div class="col-3 pl-0">
            <div class="card">
                <div class="position-relative">
                    @if (! $user->userInfo->photo)
                    <div class="card-img-top display-3 text-center">
                        <i class="fa fa-3x fa-user-circle"></i>
                    </div>
                    @else
                    <img src="{{ route('photos.users.show', ['user'=>$user->login,'photo'=>$user->userInfo->photo]) }}" alt="user photo" class="card-img-top">
                    @endif
                    <div class="card-img-overlay text-right">
                        <div class="btn btn-light">
                            Рейтинг: <b>{{ $user->userInfo->rate }}</b>
                        </div>
                    </div>
                </div>
                @can ('edit', $user, Auth::user())
                <div class="card-body">
                    <div class="w-100">
                        <a href="{{ route('users.edit', ['login'=>Auth::user()->login]) }}" class="btn btn-light w-100">
                            <i class="fa fa-cog mr-2"></i> Настройки
                        </a>
                    </div>
                </div>
                @endcan
            </div>
        </div>
        <div class="col-9 pr-0">
            <h2 class="h2">Информация о пользователе</h2>
            <hr class="hr">
            <div class="d-flex justify-content-between align-content-center">
                <div class="col pl-0 border-right py-2">
                    <h5 class="h5 text-secondary">Имя</h5>
                </div>
                <div class="col-8 py-2">
                    <div class="h5">
                        {{ $user->userInfo->name }}
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-content-center">
                <div class="col pl-0 border-right py-2">
                    <h5 class="h5 text-secondary">Фамилия</h5>
                </div>
                <div class="col-8 py-2">
                    <div class="h5">
                        {{ $user->userInfo->lastname }}
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-content-center">
                <div class="col pl-0 border-right py-2">
                    <h5 class="h5 text-secondary">Отчество</h5>
                </div>
                <div class="col-8 py-2">
                    <div class="h5">
                        {{ $user->userInfo->middlename != null ? $user->userInfo->middlename : 'Отсутствует' }}
                    </div>
                </div>
            </div>
            <hr class="hr">
            <h2 class="h2">Контакты</h2>
            <hr class="hr">
            <div class="d-flex justify-content-between align-content-center">
                <div class="col pl-0 border-right py-2">
                    <h5 class="h5 text-secondary">Email</h5>
                </div>
                <div class="col-8 py-2">
                    <div class="h5">
                        {{ $user->userInfo->email != null ? $user->userInfo->email : 'Отсутствует' }}
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-content-center">
                <div class="col pl-0 border-right py-2">
                    <h5 class="h5 text-secondary">Телефон</h5>
                </div>
                <div class="col-8 py-2">
                    <div class="h5">
                        {{ $user->userInfo->phone != null ? $user->userInfo->phone : 'Отсутствует' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="hr">
    <h2 class="h2">Образовательная организация</h2>
    <hr class="hr">
    <div class="d-flex justify-content-between align-content-center">
        <div class="col pl-0 border-right py-2">
            <h5 class="h5 text-secondary">Название организации</h5>
        </div>
        <div class="col-8 py-2">
            <div class="h5">
                <a href="{{ route('organizations.show', ['id'=>$user->userInfo->educationOrganization->id]) }}">
                    {{ $user->userInfo->educationOrganization->shortname != null ? $user->userInfo->educationOrganization->shortname : $user->userInfo->educationOrganization->name }}
                </a>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between align-content-center">
        <div class="col pl-0 border-right py-2">
            <h5 class="h5 text-secondary">Должность</h5>
        </div>
        <div class="col-8 py-2">
            <div class="h5">
                {{ $user->userInfo->position->name }}
            </div>
        </div>
    </div>
    <hr class="hr">
    <h2 class="h2">О себе</h2>
    <hr class="hr">
    <div class="h5 text-secondar">
        {{ $user->userInfo->about }}
    </div>
    <hr class="hr">
    @can('teach', Auth::user())
    <div class="d-flex my-4">
        <div class="col-lg-6 pl-0">
            <div class="card user-materials">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Материалы пользователя
                        @can ('edit', $user, Auth::user())
                        <a href="{{ route('materials.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus mr-2"></i>Создать</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($materials as $material)
                        <div class="list-group-item material">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('materials.show', ['id'=>$material->id]) }}" class="material__link">{{ $material->name }}</a>
                                <p class="material__date text-secondary">{{ $material->date }}</p>
                            </div>
                        </div>
                        @empty
                        @can ('edit', $user, Auth::user())
                        <div class="list-group-item text-secondary d-flex align-items-center justify-content-center">Все ждут ваши материалы!</div>
                        @else
                        <div class="list-group-item text-secondary d-flex align-items-center justify-content-center">Пользователь еще ничего не добавил!</div>
                        @endcan
                        @endforelse
                        @if ($materials->count() > 5)
                        <a href="#" class="btn btn-primary">Показать все</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 pr-0">
            <div class="card user-news">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Новости пользователя
                        @can ('administrate', Auth::user())
                        <a href="{{ route('news.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus mr-2"></i>Создать</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($news as $item)
                        <div class="list-group-item news">
                            <div class="d-flex justify-content-between">
                                <div class="col-7 pl-0">
                                    <a href="#" class="news__link">{{ $item->header }}</a>
                                </div>
                                <p class="news__date text-secondary">{{ $item->date }}</p>
                            </div>
                        </div>
                        @empty
                        @can ('edit', $user, Auth::user())
                        <div class="list-group-item text-secondary d-flex align-items-center justify-content-center">Все ждут ваши новости!</div>
                        @else
                        <div class="list-group-item text-secondary d-flex align-items-center justify-content-center">Пользователь еще ничего не добавил!</div>
                        @endcan
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan
    <div class="card actions mt-4">
        <div class="card-header">Действия пользователя</div>
        <div class="card-body p-0">
            <div class="list-group list-group-flush">
                @forelse($actions as $action)
                <div class="list-group-item action">
                    <div class="d-flex justify-content-between py-2">
                        <div>{{ $action->description }}</div>
                        <div class="text-secodary">
                            {{ date( "H:i d M Y", strtotime($action->date)) }}
                        </div>
                    </div>
                </div>
                @empty
                <div class="list-group-item text-secondary d-flex align-items-center justify-content-center">Пользователь ничего не делал...</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
</div>
@endsection