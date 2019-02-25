@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-3">
        <div class="position-relative">
            @if ($news->image)
            <img src="{{ asset('storage/images/' . $news->image) }}" alt="photo" class="card-img-bottom">
            @endif
            <div class="card-img-overlay text-right">
                <div class="btn-group">
                    @can('administrate', Auth::user())
                    <a href="{{ route('news.edit', ['id'=>$news->id]) }}" class="btn btn-light"><i class="fa fa-pencil"></i></a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card-body pb-0">
            <h1 class="card-title">
                <a href="{{ route('news.show', ['id'=>$news->id]) }}">
                    {{ $news->header }}
                </a>
            </h1>
            <div class="card-text">
                <p class="text-muted">{{ date( "d.m.Y в H:i", strtotime($news->date)) }}</p>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            {{ $news->description }}
        </div>
    </div>
</div>
@endsection