@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card profile">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="profile__title">Личный кабинет</div>
                <div class="profile__role">{{ $user->login }}</div>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="d-flex">
                <div class="col-3">
                    <div class="profile__photo">
                        @if (! $user->userInfo->photo)
                        <img src="{{ asset('storage/default.png') }}" alt="photo" class="w-100">
                        @else
                        <img src="{{ asset('storage/userdata/' . $user->login . '/' . $user->userInfo->photo) }}" alt="user photo" class="w-100">
                        @endif
                    </div>
                </div>
                <div class="col-9">
                    <div class="profile__info">
                        <p class="profile__name">
                            {{ $user->userInfo->name . ' ' . $user->userInfo->lastname }}
                            <span class="badge badge-info">{{ $user->role->name }}</span>
                        </p>
                        <p class="profile__desc text-secondary">{{ $user->userInfo->about }}</p>
                        <p class="profile__organization">
                            Образовательная организация: {{ $user->userInfo->educationOrganization->name }}
                        </p>
                        <p class="profile__post">
                            Должность: {{ $user->userInfo->position->name }}
                        </p>
                        <p class="profile__email">
                            @if ($user->userInfo->email != null)
                            Электронная почта: {{ $user->userInfo->email }}
                            @endif
                        </p>
                        <p class="profile__phone">
                            @if ($user->userInfo->phone != null)
                            Телефон: {{ $user->userInfo->phone }}
                            @endif
                        </p>
                        <p class="profile__rate">Рейтинг пользователя: {{ $user->userInfo->rate }}</p>
                        @can ('edit', $user, Auth::user())
                        <p class="profile__edit"><a href="/user/{{ Auth::user()->login }}/settings">Настройки</a></p>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex my-4">
        <div class="col-lg-6">
            <div class="card user-materials">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Материалы пользователя
                        @can ('edit', $user, Auth::user())
                        <a href="{{ route('materialCreate') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus mr-2"></i>Создать</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    @forelse($materials as $material)
                    <div class="material">
                        <div class="d-flex justify-content-between">
                            <a href="/material/{{ $material->id }}" class="material__link">{{ $material->name }}</a>
                            <p class="material__date text-secondary">{{ $material->date }}</p>
                        </div>
                    </div>
                    @empty
                    @can ('edit', $user, Auth::user())
                    <div class="text-secondary d-flex align-items-center justify-content-center">Все ждут ваши материалы!</div>
                    @else
                    <div class="text-secondary d-flex align-items-center justify-content-center">Пользователь еще ничего не добавил!</div>
                    @endcan
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card user-news">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Новости пользователя
                    </div>
                </div>
                <div class="card-body">
                    @forelse($news as $item)
                    <div class="news">
                        <div class="d-flex justify-content-between">
                            <div class="col-7 pl-0">
                                <a href="#" class="news__link">{{ $item->header }}</a>
                                <div class="news__theme text-secondary">{{ $item->theme }}</div>
                            </div>
                            <p class="news__date text-secondary">{{ $item->date }}</p>
                        </div>
                    </div>
                    @empty
                    @can ('edit', $user, Auth::user())
                    <div class="text-secondary d-flex align-items-center justify-content-center">Все ждут ваши новости!</div>
                    @else
                    <div class="text-secondary d-flex align-items-center justify-content-center">Пользователь еще ничего не добавил!</div>
                    @endcan
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    @can('administrate', Auth::user(), $user)
    @can ('edit', $user, Auth::user())
    <div class="d-flex my-4">
        <div class="col-lg-6">
            <div class="card education-organizations">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Образовательные организации
                        <a href="{{ route('educationOrganizations') }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    @forelse($organizations as $organization)
                    <div class="education-organization">
                        <div class="d-flex justify-content-between py-2">
                            <a href="#" class="education-organization__link">{{ $organization->name }}</a>
                        </div>
                    </div>
                    @empty
                    <div class="text-secondary d-flex align-items-center justify-content-center">Добавьте уже образовательные организации!</div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card specialties">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Специальности
                        <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus mr-2"></i>Создать</a>
                    </div>
                </div>
                <div class="card-body">
                    @forelse($specialties as $specialty)
                    <div class="specialty">
                        <div class="d-flex justify-content-between py-2">
                            <a href="#" class="specialty__link">{{ $specialty->name }}</a>
                        </div>
                    </div>
                    @empty
                    <div class="text-secondary d-flex align-items-center justify-content-center">Добавьте уже специальности!</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex my-4">
        <div class="col-lg-6">
            <div class="card subjects">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Дисциплины
                        <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus mr-2"></i>Создать</a>
                    </div>
                </div>
                <div class="card-body">
                    @forelse($subjects as $subject)
                    <div class="subject">
                        <div class="d-flex justify-content-between py-2">
                            <a href="#" class="subject__link">{{ $subject->name }}</a>
                        </div>
                    </div>
                    @empty
                    <div class="text-secondary d-flex align-items-center justify-content-center">Добавьте уже дисциплины!</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    @endcan
    @endcan
    <div class="card actions">
        <div class="card-header">Действия пользователя</div>
        <div class="card-body">

        </div>
    </div>
</div>
</div>
@endsection