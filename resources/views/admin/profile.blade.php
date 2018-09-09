@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card profile">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="profile__title">Личный кабинет</div>
                <div class="profile__role">{{ Auth::user()->role->name }}</div>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="d-flex">
                <div class="col-3">
                    <div class="profile__photo">
                        @if (! Auth::user()->userInfo->photo)
                        <img src="{{ asset('storage/default.png') }}" alt="photo" class="w-100">
                        @else
                        <img src="{{ asset('storage/userdata/' . Auth::user()->login . '/' . Auth::user()->userInfo->photo) }}" alt="user photo" class="w-100">
                        @endif
                    </div>
                </div>
                <div class="col-9">
                    <div class="profile__info">
                        <p class="profile__name">{{ Auth::user()->userInfo->name . ' ' . Auth::user()->userInfo->lastname }}</p>
                        <p class="profile__desc text-secondary">{{ Auth::user()->userInfo->about }}</p>
                        <p class="profile__organization">
                            Образовательная организация: {{ Auth::user()->userInfo->educationOrganization->name }}
                        </p>
                        <p class="profile__rate">Рейтинг пользователя: {{ Auth::user()->userInfo->rate }}</p>
                        <p class="profile__edit"><a href="/profile/settings">Настройки</a></p>
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
                        <a href="{{ route('materialCreate') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus mr-2"></i>Создать</a>
                    </div>
                </div>
                <div class="card-body">
                    @forelse($materials as $material)
                    <div class="material">
                        <div class="d-flex justify-content-between py-2">
                            <a href="/material/{{ $material->id }}" class="material__link">{{ $material->name }}</a>
                            <p class="material__date text-secondary">{{ $material->date }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="text-secondary d-flex align-items-center justify-content-center">Все ждут ваши материалы!</div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card user-news">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Новости пользователя
                        <a href="/news/create" class="btn btn-primary btn-sm"><i class="fa fa-plus mr-2"></i>Создать</a>
                    </div>
                </div>
                <div class="card-body">
                    @forelse($news as $item)
                    <div class="news">
                        <div class="d-flex justify-content-between py-2">
                            <a href="#" class="news__link">{{ $item->header }}</a>
                            <p class="news__date text-secondary">{{ $item->date }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="text-secondary d-flex align-items-center justify-content-center">Все ждут ваши новости!</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex my-4">
        <div class="col-lg-6">
            <div class="card education-organizations">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Образовательные организации
                        <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus mr-2"></i>Создать</a>
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
        <div class="col-lg-6">
            <div class="card users">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Пользователи
                        <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus mr-2"></i>Создать</a>
                    </div>
                </div>
                <div class="card-body">
                    @forelse($users as $user)
                    <div class="user">
                        <div class="d-flex justify-content-between py-2">
                            <a href="#" class="user__link">{{ $user->login }}</a>
                        </div>
                    </div>
                    @empty
                    <div class="text-secondary d-flex align-items-center justify-content-center">Добавьте уже пользователей!</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection