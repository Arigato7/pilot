@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Фильтр
        </div>
        <div class="card-body p-0">
            <h1 class="h1 p-4">
                {{ $title }}
            </h1>
            <div class="list-group list-group-flush">
                @forelse($materials as $material)
                <div class="list-group-item material">
                    <div class="d-flex justify-content-between">
                        <div class="col-lg-5">
                            <a href="{{ route('materials.show', ['id'=>$material->id]) }}" class="material__link">{{ $material->name }}</a>
                            <p class="material__author">
                                <a href="/user/{{ $material->user_login }}" class="text-secondary"  data-toggle="tooltip" data-html="true" data-placement="top" title="<div class='d-flex justify-content-between align-items-center'><div style='width: 50px;'><img class='w-100' src='{{ $material->user_photo != null ? asset('storage/userdata/' . $material->user_login . '/' . $material->user_photo) : asset('storage/default.png') }}'></div><div class='text-center font-weight-bold col'>{{ $material->user_name }}</div></div>">{{ $material->user_name }}</a>
                            </p>
                        </div>
                        <p class="material__date text-secondary">{{ date( "H:i d.m.Y", strtotime($material->date)) }}</p>
                    </div>
                </div>
                @empty
                <div class="list-group-item text-center text-secondary">
                    Пусто
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection