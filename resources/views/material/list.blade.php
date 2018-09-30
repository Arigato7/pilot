@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h1 mb-4 col">Депозиторий</h1>
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
                        <a href="{{ route('materialTypes') }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="right" title="Изменить"><i class="fa fa-edit"></i></a>
                        @endcan
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($types as $type)
                        <div class="list-group-item subject">
                            <a href="/material/filter/type/{{ $type->id }}">{{ $type->name }}</a>
                        </div>
                        @empty
                        <div class="list-group-item text-center text-secondary">
                            Пусто
                        </div>
                        @endforelse
                        @if ($types->count() > 5)
                        <a href="#" class="btn btn-primary">Показать все</a>
                        @endif
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
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($specialties as $specialty)
                        <div class="list-group-item specialty">
                            <div class="d-flex justify-content-between">
                                <a href="/material/filter/specialty/{{ $specialty->id }}" class="d-block">{{ $specialty->name }}</a>
                                <div class="text-secondary">{{ $specialty->code }}</div>
                            </div>
                        </div>
                        @empty
                        <div class="list-group-item text-center text-secondary">
                            Пусто
                        </div>
                        @endforelse
                        @if ($specialties->count() > 5)
                        <a href="#" class="btn btn-primary">Показать все</a>
                        @endif
                    </div>
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
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($subjects as $subject)
                        <div class="list-group-item subject">
                            <a href="/material/filter/subject/{{ $subject->id }}">{{ $subject->name }}</a>
                        </div>
                        @empty
                        <div class="list-group-item text-center text-secondary">
                            Пусто
                        </div>
                        @endforelse
                        @if ($subjects->count() > 5)
                        <a href="#" class="btn btn-primary">Показать все</a>
                        @endif
                    </div>
                </div>
            </div>
            @can ('moderate', Auth::user())
            <div class="card mt-2">
                <a href="{{ route('materialComplaints') }}" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Список жалоб на материалы">Жалобы на материалы</a>
            </div>
            @endcan
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Список материалов
                        <a href="{{ route('materialCreate') }}" class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="right" title="Создать"><i class="fa fa-plus mr-2"></i>Создать</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <h2 class="h2 p-4">Последние добавленные</h2>
                    <div class="list-group list-group-flush">
                        @forelse($newMaterials as $newMaterial)
                        <div class="list-group-item material">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="col-lg-7 pl-0">
                                    <h3>
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
                                    </h3>
                                    <div class="text-secondary">
                                        Автор: 
                                        <a href="/user/{{ $newMaterial->user_login }}" class="text-secondary"  data-toggle="tooltip" data-html="true" data-placement="top" title="<div class='d-flex justify-content-between align-items-center'><div style='width: 50px;'><img class='w-100' src='{{ $newMaterial->user_photo != null ? asset('storage/userdata/' . $newMaterial->user_login . '/' . $newMaterial->user_photo) : asset('storage/default.png') }}'></div><div class='text-center font-weight-bold col'>{{ $newMaterial->user_name }}</div></div>">{{ $newMaterial->user_name }}</a> 
                                        Оценка - {{ $newMaterial->rate }}
                                    </div>
                                </div>
                                <div class="material__date">
                                    <a href="/material/{{ $newMaterial->id }}" class="btn btn-lg btn-primary w-100">Открыть</a>
                                    <div class="text-secondary">
                                        {{ date( "d.m.Y в H:i", strtotime($newMaterial->date)) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="list-group-item text-center text-secondary py-5">
                            <p class="h3">Пусто</p>
                        </div>
                        @endforelse
                        @if ($newMaterials->count() > 5)
                        <a href="#" class="btn btn-primary">Показать все</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection