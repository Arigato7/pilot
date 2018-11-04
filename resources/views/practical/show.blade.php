@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            {{ $practical->name }}
        </div>
        <div class="card-body">
            <h3 class="h3">
                <div class="d-flex justify-content-between align-items-center">
                    {{ $practical->name }}
                    <a href="{{ $practical->resource }}" class="btn btn-primary btn-lg">Открыть</a>
                </div>
            </h3>
            <div class="py-4">
                {{ $practical->description }}
            </div>
            <div class="text-secondary">
                {{ date( "d.m.Y в H:i", strtotime($practical->date)) }}
            </div>
        </div>
    </div>
</div>
@endsection