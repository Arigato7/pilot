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
                    <div class="text-secondary">
                        Количество часов: {{ $course->duration }} ч. <br>
                        Количество участников: {{ $members_count }}
                    </div>
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
                            <div class="btn-group">
                            @can('course-entry', $course)
                                @if ($date_diff)
                                <a href="#" class="btn btn-lg btn-primary"  
                                onclick="event.preventDefault();
                                            document.getElementById('entry-course').submit();">Записаться</a>
                                <form id="entry-course" action="{{ route('courses.enroll', ['id'=>$course->id]) }}" method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="date" value="{{ date( "Y-m-d H:i:s", strtotime("now")) }}">
                                </form>
                                @else
                                    <div class="btn btn-lg btn-danger">Запись закрыта</div>
                                @endif
                            @else
                                <button class="btn btn-lg btn-light" onclick="event.preventDefault(); if (confirm('Вы уверены?')) { document.getElementById('cancel-course').submit(); alert('Вы отписались от курса {{ $course->name }}!'); }">Отписаться</button>
                                <form action="{{ route('courses.cancel', ['id'=>$course->id]) }}" id="cancel-course" method="post" style="display: none;">
                                    @csrf
                                </form>
                            @endcan
                            @can ('administrate', Auth::user())
                                <button type="button" class="btn btn-light" onclick="event.preventDefault(); if (confirm('Вы уверены?')) { document.getElementById('delete-course').submit(); alert('Курс удален!'); }">
                                    <i class="fa fa-2x fa-close"></i>
                                </button>
                                <a href="{{ route('courses.edit', ['id'=>$course->id]) }}" class="btn btn-light">
                                    <i class="fa fa-2x fa-edit"></i>
                                </a>
                                <form action="{{ route('courses.delete', ['id'=>$course->id]) }}" id="delete-course" method="post" style="display: none;">
                                    @csrf
                                </form>
                            @endcan
                            </div>
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
    <div class="card mt-3">
        <div class="card-header">
            Файлы курса
        </div>
        <div class="card-body p-0">
            @can('edit-course', $course)
            <form action="#" method="post" id="course-file-form">
                <input type="hidden" id="course_id" value="{{ $course->id }}" style="display: none;">
                <div class="dropzone p-5 text-center text-secondary" id="course-file-dropzone">
                    <i class="fa fa-file mr-2"></i> Для загрузки файла, перетащите его сюда
                </div>
            </form>
            @endcan
            <table class="table table-sm  table-borderless table-hover mb-0">
                <thead>
                    <tr class="text-left">
                        <th class="w-75" scope="col">Название</th>
                        <th scope="col">Тип</th>
                        <th scope="col">Размер</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id="course-files">
                    @forelse ($files as $file)
                    <tr class="text-center" id="file-{{ $file->id }}">
                        <td class="w-75">
                            <div class="d-flex align-items-center justify-content-start">
                                <i class="fa fa-{{ $fileTypes[$file->type] }} mr-2"></i>
                                {{ $file->alias }}
                            </div>
                        </td>
                        <td class="text-left">{{ $file->type }}</td>
                        <td class="text-right">{{ $fileSizes[$file->fullname] }} мб</td>
                        <td class="text-right">
                            <div class="btn-group">
                                <a href="{{ route('corses.files.download', ['id'=>$file->id]) }}" class="btn btn-light">
                                    Скачать
                                </a>
                                @can('edit-course', $course)
                                <button type="button" class="btn btn-light js-delete-file-btn" id="file-delete-btn-{{ $file->id }}">
                                    Удалить
                                </button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-secondary">Пусто</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
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
            <form action="{{ route('courses.comment.store', ['id'=>$course->id]) }}" method="post" id="create-course-comment">
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
                <div class="d-flex">
                    <div class="text-secondary">author</div>
                    <div class="ml-4">
                        {{ $comment->description }}
                    </div>
                </div>
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