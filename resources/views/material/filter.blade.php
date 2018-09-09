@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Фильтр
        </div>
        <div class="card-body">
            <h1 class="h1 mb-4">
                {{ $title }}
            </h1>
            @forelse($materials as $material)
            <div class="material">
                <div class="d-flex justify-content-between">
                    <div class="col-lg-5">
                        <a href="/material/{{ $material->id }}" class="material__link">{{ $material->name }}</a>
                        <p class="material__author">
                            <a href="/user/{{ $material->user_login }}" class="text-secondary"  data-toggle="tooltip" data-html="true" data-placement="top" title="<div class='d-flex justify-content-between align-items-center'><div style='width: 50px;'><img class='w-100' src='{{ $material->user_photo != null ? asset('storage/userdata/' . $material->user_login . '/' . $material->user_photo) : asset('storage/default.png') }}'></div><div class='text-center font-weight-bold col'>{{ $material->user_name }}</div></div>">{{ $material->user_name }}</a>
                        </p>
                    </div>
                    <p class="material__date text-secondary">{{ $material->date }}</p>
                </div>
            </div>
            @empty
            <div class="text-center text-secondary py-4">
                Пусто
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection