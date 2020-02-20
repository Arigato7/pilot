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
                <div class="col-lg-3 pl-0">
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
                                    <a href="{{ route('materials.filter.type', ['id'=>$type->id]) }}" title="{{ $type->name }}">
                                        <i class="fa fa-book"></i> {{ str_limit($type->name, 25) }}
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
                                        <a href="{{ route('materials.filter.specialty', ['id'=>$specialty->id]) }}" class="d-block" title="{{ $specialty->name }}">{{ str_limit($specialty->name, 25) }}</a>
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
                                    <a href="{{ route('materials.filter.subject', ['id'=>$subject->id]) }}" title="{{ $subject->name }}">
                                        <i class="fa fa-book"></i> {{ str_limit($subject->name, 25) }}
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
                <div class="col-lg-9 pr-0">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 class="h4">Список материалов</h4>
                        <a href="{{ route('materials.create') }}" class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="right" title="Создать"><i class="fa fa-plus mr-2"></i>Создать</a>
                    </div>
                    <div class="p-2 font-size-0 text-center">
                    @forelse($materials as $material)
                        <div class="card col-lg-3 p-0 material-item d-inline-block mr-3 mb-3">
                            <div class="card-body d-flex justify-content-center align-items-center flex-column">
                                <div class="text-center">
                                    <i class="fa fa-4x fa-{{ $material_types[$material->content_type] }}"></i>
                                </div>
                                <div class="pl-0">
                                    <h4 class="text-center my-2">
                                        <a href="{{ route('materials.show', ['id'=>$material->id]) }}" title="{{ $material->name }}" class="material__link">
                                            {{ str_limit($material->name, 30) }}
                                        </a>
                                    </h4>
                                    <div class="text-secondary text-center">
                                        <a href="{{ route('users.show', ['login'=>$material->user_login]) }}" class="text-secondary mr-2"  data-toggle="tooltip" data-html="true" data-placement="top" title="<div class='d-flex justify-content-between align-items-center'><div style='width: 50px;'><img class='w-100' src='{{ $material->user_photo != null ? asset('storage/userdata/' . $material->user_login . '/' . $material->user_photo) : asset('storage/default.png') }}'></div><div class='text-center font-weight-bold col'>{{ $material->user_name . ' ' . $material->user_lastname }}</div></div>">{{ $material->user_name . ' ' . $material->user_lastname }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="pr-0 text-center material__date">
                                    <a href="{{ route('materials.show', ['id'=>$material->id]) }}" class="btn btn-sm btn-primary">Открыть</a>
                                    <div class="text-secondary">
                                        {{ date( "d.m.Y в H:i", strtotime($material->date)) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
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
                    @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection