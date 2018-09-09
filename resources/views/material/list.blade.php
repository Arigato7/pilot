@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <h1 class="h1 mb-4 col">Материалы</h1>
        <div class="col-8">
            <form id="search-material" action="/material/find" method="post">
                @csrf
                <div class="d-flex justify-content-between btn-group">
                    <input type="text" id="materialSearch" name="materialName" class="form-control" placeholder="Название материала" required>
                    <button type="submit" class="btn btn-primary" style="margin-left: -2px;">Искать</button>
                </div>
            </form>
        </div>
    </div>
    <div class="d-flex justify-content-between">
        <div class="col-lg-4">
            <div class="card material-types mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Типы материалов
                        @can ('administrate', Auth::user())
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="right" title="Изменить"><i class="fa fa-edit"></i></a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    @forelse($types as $type)
                    <div class="subject">
                        <a href="/material/filter/type/{{ $type->id }}">{{ $type->name }}</a>
                    </div>
                    @empty
                    <div class="text-center text-secondary">
                        Пусто
                    </div>
                    @endforelse
                    <div class="text-center">
                        <a href="#">Показать все</a>
                    </div>
                </div>
            </div>
            <div class="card specialties mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Специальности
                        @can ('administrate', Auth::user())
                        <a href="{{ route('specialties') }}" class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="right" title="Изменить"><i class="fa fa-edit"></i></a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    @forelse($specialties as $specialty)
                    <div class="subject">
                        <div class="d-flex justify-content-between">
                            <a href="/material/filter/specialty/{{ $specialty->id }}" class="d-block">{{ $specialty->name }}</a>
                            <div class="text-secondary">{{ $specialty->code }}</div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-secondary">
                        Пусто
                    </div>
                    @endforelse
                    @if ($specialties->count() > 0)
                    <div class="text-center py-2">
                        <a href="{{ route('specialties') }}">Показать все</a>
                    </div>
                    @endif
                </div>
            </div>
            <div class="card subjects">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Дисциплины
                        @can ('administrate', Auth::user())
                        <a href="#" class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="right" title="Изменить"><i class="fa fa-edit"></i></a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    @forelse($subjects as $subject)
                    <div class="subject">
                        <a href="/material/filter/subject/{{ $subject->id }}">{{ $subject->name }}</a>
                    </div>
                    @empty
                    <div class="text-center text-secondary">
                        Пусто
                    </div>
                    @endforelse
                    @if ($subjects->count() > 0)
                    <div class="text-center py-2">
                        <a href="#">Показать все</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Список материалов
                        <a href="{{ route('materialCreate') }}" class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="right" title="Создать"><i class="fa fa-plus mr-2"></i>Создать</a>
                    </div>
                </div>
                <div class="card-body">
                    <h2 class="h2 mb-4">Популярные</h2>
                    @forelse($topMaterials as $topMaterial)
                    <div class="material mb-2">
                        <div class="d-flex justify-content-between">
                            <div class="col-lg-7 pl-0">
                                <a href="/material/{{ $topMaterial->id }}" class="material__link">
                                    {{ $topMaterial->name }}
                                    <span class="ml-1 badge {{ $topMaterial->status == 'new' ? 'badge-success' : 'badge-primary' }}" data-toggle="tooltip" data-placement="right" title="Статус материала">
                                        @if ($topMaterial->status == 'new')
                                        Новый
                                        @elseif ($topMaterial->status == 'updated')
                                        Обновлен
                                        @else
                                        Восстановлен
                                        @endif
                                    </span>
                                </a>
                                <div class="text-secondary">
                                    Оценка - {{ $topMaterial->rate }}
                                </div>
                            </div>
                            <div class="material__date text-secondary">
                                <div class="material__author">
                                    <a href="/user/{{ $topMaterial->user_login }}" class="text-secondary"  data-toggle="tooltip" data-html="true" data-placement="top" title="<div class='d-flex justify-content-between align-items-center'><div style='width: 50px;'><img class='w-100' src='{{ $topMaterial->user_photo != null ? asset('storage/userdata/' . $topMaterial->user_login . '/' . $topMaterial->user_photo) : asset('storage/default.png') }}'></div><div class='text-center font-weight-bold col'>{{ $topMaterial->user_name }}</div></div>">{{ $topMaterial->user_name }}</a>
                                </div>
                                {{ $topMaterial->date }}
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-secondary py-5">
                        <p class="h3">Пусто</p>
                    </div>
                    @endforelse
                    @if ($topMaterials->count() > 0)
                    <div class="text-center py-2">
                        <a href="#">Показать все</a>
                    </div>
                    @endif
                    <h2 class="h2 mb-4">Новые</h2>
                    @forelse($newMaterials as $newMaterial)
                    <div class="material mb-2">
                        <div class="d-flex justify-content-between">
                            <div class="col-lg-7 pl-0">
                                <a href="/material/{{ $newMaterial->id }}" class="material__link">
                                    {{ $newMaterial->name }}
                                    <span class="ml-1 badge {{ $newMaterial->status == 'new' ? 'badge-success' : 'badge-primary' }}" data-toggle="tooltip" data-placement="right" title="Статус материала">
                                        @if ($newMaterial->status == 'new')
                                        Новый
                                        @elseif ($newMaterial->status == 'updated')
                                        Обновлен
                                        @else
                                        Восстановлен
                                        @endif
                                    </span>
                                </a>
                                <div class="text-secondary">
                                    Оценка - {{ $newMaterial->rate }}
                                </div>
                            </div>
                            <div class="material__date text-secondary">
                                <div class="material__author">
                                    <a href="/user/{{ $newMaterial->user_login }}" class="text-secondary"  data-toggle="tooltip" data-html="true" data-placement="top" title="<div class='d-flex justify-content-between align-items-center'><div style='width: 50px;'><img class='w-100' src='{{ $newMaterial->user_photo != null ? asset('storage/userdata/' . $newMaterial->user_login . '/' . $newMaterial->user_photo) : asset('storage/default.png') }}'></div><div class='text-center font-weight-bold col'>{{ $newMaterial->user_name }}</div></div>">{{ $newMaterial->user_name }}</a>
                                </div>
                                {{ $newMaterial->date }}
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-secondary py-5">
                        <p class="h3">Пусто</p>
                    </div>
                    @endforelse
                    @if ($newMaterials->count() > 0)
                    <div class="text-center py-2">
                        <a href="#">Показать все</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection