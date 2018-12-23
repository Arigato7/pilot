@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <div class="bg-white"></div>
        <div class="col p-0">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h1 mb-4 col pl-0">Депозиторий</h1>
                <div class="col-8">
                    {{-- <form id="search-material" action="/material/find" method="post">
                        @csrf
                        <div class="d-flex justify-content-between btn-group">
                            <input type="text" id="materialSearch" name="materialName" class="form-control" placeholder="Название материала" required>
                            <button type="submit" class="btn btn-primary" style="margin-left: -2px;">Искать</button>
                        </div>
                    </form> --}}
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="col-lg-4 pl-0">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 class="h4">Типы материалов</h4>
                        @can ('administrate', Auth::user())
                        <a href="{{ route('materials.types') }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="right" title="Изменить"><i class="fa fa-pencil"></i></a>
                        @endcan
                    </div>
                    <div class="card material-types mb-4">
                        <div class="card-body p-0">
                            <div class="list-group">
                                @forelse($types as $type)
                                <div class="list-group-item subject">
                                    <a href="{{ route('materials.filter.type', ['id'=>$type->id]) }}">
                                        <i class="fa fa-book"></i> {{ $type->name }}
                                    </a>
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
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 class="h4">Специальности</h4>
                        @can ('administrate', Auth::user())
                        <a href="{{ route('specialties') }}" class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="right" title="Изменить"><i class="fa fa-pencil"></i></a>
                        @endcan
                    </div>
                    <div class="card specialties mb-4">
                        <div class="card-body p-0">
                            <div class="list-group">
                                @forelse($specialties as $specialty)
                                <div class="list-group-item specialty">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('materials.filter.specialty', ['id'=>$specialty->id]) }}" class="d-block">{{ $specialty->name }}</a>
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
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 class="h4">Дисциплины</h4>
                        @can ('administrate', Auth::user())
                        <a href="{{ route('subjects') }}" class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="right" title="Изменить"><i class="fa fa-pencil"></i></a>
                        @endcan
                    </div>
                    <div class="card subjects">
                        <div class="card-body p-0">
                            <div class="list-group">
                                @forelse($subjects as $subject)
                                <div class="list-group-item subject">
                                    <a href="{{ route('materials.filter.subject', ['id'=>$subject->id]) }}">
                                        <i class="fa fa-book"></i> {{ $subject->name }}
                                    </a>
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
                        <a href="{{ route('materials.complaints') }}" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Список жалоб на материалы">Жалобы на материалы</a>
                    </div>
                    @endcan
                </div>
                <div class="col-lg-8 pr-0">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 class="h4">Список материалов</h4>
                        <a href="{{ route('materials.create') }}" class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="right" title="Создать"><i class="fa fa-plus mr-2"></i>Создать</a>
                    </div>
                    @forelse($newMaterials as $newMaterial)
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="col-lg-7 pl-0">
                                    <h3>
                                        <a href="{{ route('materials.show', ['id'=>$newMaterial->id]) }}" class="material__link">
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
                                        <a href="{{ route('users.show', ['login'=>$newMaterial->user_login]) }}" class="text-secondary"  data-toggle="tooltip" data-html="true" data-placement="top" title="<div class='d-flex justify-content-between align-items-center'><div style='width: 50px;'><img class='w-100' src='{{ $newMaterial->user_photo != null ? asset('storage/userdata/' . $newMaterial->user_login . '/' . $newMaterial->user_photo) : asset('storage/default.png') }}'></div><div class='text-center font-weight-bold col'>{{ $newMaterial->user_name . ' ' . $newMaterial->user_lastname }}</div></div>">{{ $newMaterial->user_name . ' ' . $newMaterial->user_lastname }}</a> 
                                        Оценка - {{ $newMaterial->rate }}
                                    </div>
                                </div>
                                <div class="material__date">
                                    <a href="{{ route('materials.show', ['id'=>$newMaterial->id]) }}" class="btn btn-lg btn-primary w-100">Открыть</a>
                                    <div class="text-secondary">
                                        {{ date( "d.m.Y в H:i", strtotime($newMaterial->date)) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="text-center text-secondary py-5">
                                <div class="h3">
                                    <i class="fa fa-2x fa-info"></i>
                                </div>
                                <div class="h4 mb-3">
                                    Материалов не найдено!
                                </div>
                                @can ('administrate', Auth::user())
                                <a href="{{ route('materials.create') }}" class="btn btn-primary">
                                    <i class="fa fa-plus mr-2"></i>Создать
                                </a>
                                @endcan
                            </div>
                        </div>
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
@endsection