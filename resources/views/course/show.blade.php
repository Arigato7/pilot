@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card course">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                {{ $course->name }}
                <div class="text-secondary">Место проведения: {{ $course->place }}</div>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="h2">
                        {{ $course->name }}
                    </h2>
                    <div class="text-secondary">Количество часов: {{ $course->duration }} ч.</div>
                </div>
                <div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between">
                            <div class="col-7 text-right">
                                <div><b>Дата начала</b></div>
                                <div><b>Дата окончания</b></div>
                            </div>
                            <div class="col-7 text-left">
                                <div class="text-secondary">{{ date( "d.m.Y с H:i", strtotime($course->start_date)) }}</div>
                                <div class="text-secondary">{{ date( "d.m.Y до H:i", strtotime($course->end_date)) }}</div>
                            </div>
                        </div>
                        <div class="ml-5">
                            @can('course-entry', $course)
                                @if ($date_diff)
                                <a href="#" class="btn btn-lg btn-primary"  
                                onclick="event.preventDefault();
                                            document.getElementById('entry-course').submit();">Записаться</a>
                                <form id="entry-course" action="/course/{{ $course->id }}/entry" method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="date" value="{{ date( "Y-m-d H:i:s", strtotime("now")) }}">
                                </form>
                                @else
                                    <div class="btn btn-lg btn-danger">Запись закрыта</div>
                                @endif
                            @else
                                <div class="btn btn-lg btn-success">Вы записаны</div>
                            @endcan
                        </div>
                    </div>
                    @if ($date_diff)
                        <div class="text-right py-2">Записаться можно до {{ date( "d.m.Y до H:i", strtotime($course->end_entry_date)) }}</div>
                    @else
                        <div class="text-right">Запись на курс завершена</div>
                    @endif
                </div>
            </div>
            <div class="py-3">
                {{ $course->description }}
            </div>
        </div>
    </div>
    @can('create-course-comment', $course)
    <div class="card mt-3">
        <div class="list-group list-group-flush">
            <div class="list-group-item">
                <div class="d-flex justify-content-between align-items-center">
                    Оставить комментарий
                    <button type="button" class="btn btn-primary" onclick="event.preventDefault();
                    document.getElementById('create-course-comment').submit();">Отправить</button>
                </div>
            </div>
            <form action="/course/{{ $course->id }}/comment" method="post" id="create-course-comment">
                @csrf
                <textarea name="description" id="commentDescription" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }} border-0" cols="30" rows="4" placeholder="Что думаете по этому поводу?"></textarea>
                @if ($errors->has('description'))
                    <div class="invalid-tooltip">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            </form>
        </div>
    </div>
    @endcan
    <div class="card mt-3">
        <div class="list-group list-group-flush">
            @forelse ($comments as $comment)
            <div class="list-group-item course-comment">
                {{ $comment->description }}
            </div>
            @empty
            <div class="list-group-item course-comment">
                Пусто
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection