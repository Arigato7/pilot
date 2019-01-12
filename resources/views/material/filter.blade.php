@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1 mb-4">
        {{ $title }}
    </h1>
    <div class="card">
        <div class="card-body p-0">
            <div class="list-group">
                    @forelse($materials as $material)
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="col-lg-9 pl-0">
                                <h3>
                                    <a href="{{ route('materials.show', ['id'=>$material->id]) }}" class="material__link">
                                        {{ $material->name }}
                                        <span class="ml-1 badge {{ $material->status == 'new' ? 'badge-success' : 'badge-primary' }}" data-toggle="tooltip" data-placement="right" title="Статус материала">
                                            @if ($material->status == 'new')
                                            Новый
                                            @elseif ($material->status == 'updated')
                                            Обновлен
                                            @else
                                            Восстановлен
                                            @endif
                                        </span>
                                    </a>
                                </h3>
                                <div class="d-flex align-items-center text-secondary">
                                    <a href="{{ route('users.show', ['login'=>$material->user_login]) }}" class="text-secondary mr-2"  data-toggle="tooltip" data-html="true" data-placement="top" title="<div class='d-flex justify-content-between align-items-center'><div style='width: 50px;'><img class='w-100' src='{{ $material->user_photo != null ? asset('storage/userdata/' . $material->user_login . '/' . $material->user_photo) : asset('storage/default.png') }}'></div><div class='text-center font-weight-bold col'>{{ $material->user_name . ' ' . $material->user_lastname }}</div></div>">{{ $material->user_name . ' ' . $material->user_lastname }}</a> 
                                    <div class="d-flex align-items-center text-light position-relative" style="width: 67px;" data-toggle="tooltip" data-placement="top" title="Рейтинг {{ $material->rate }}">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <div class="d-flex align-items-center text-primary position-absolute" style="top: 0; overflow: hidden; width: {{ round(($material->rate / 5) * 100) }}%;">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center material__date">
                                <a href="{{ route('materials.show', ['id'=>$material->id]) }}" class="btn btn-lg btn-primary w-100">Открыть</a>
                                <div class="text-secondary">
                                    {{ date( "d.m.Y в H:i", strtotime($material->date)) }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="list-group-item">
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
@endsection