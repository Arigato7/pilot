@extends('layouts.app')

@section('content')
<div class="container">
    @if ($error == '')
    <div class="card material">
        <div class="card-header">
            Автор: <a href="/material/filter/user/{{ $user->id }}">{{ $userInfo->name . ' ' . $userInfo->lastname }}</a>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="material__header">
                    {{ $material->name }}
                </h1>
                <div class="material__panel">
                    @can('update-material', $material)
                    <a href="/material/{{ $material->id }}/edit" class="btn btn-success"><i class="fa fa-edit mr-2"></i>Редактировать</a>
                    @else
                    <a href="/complaint/create/{{ $material->id }}" class="btn btn-outline-danger"><i class="fa fa-edit mr-2"></i>Пожаловаться</a>
                    @endcan
                    @can('moderate', Auth::user())
                    <div class="dropdown d-inline-block">
                        <a href="#" class="btn btn-danger dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-close mr-2"></i>Удалить</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#" 
                                onclick="event.preventDefault();
                                              document.getElementById('del-material-forever').submit();">
                                Удалить полностью
                                <form id="del-material-forever" action="/material/{{ $material->id }}/delete/forever" method="POST" style="display: none;">
                                    @csrf
                                </form>
                             </a>
                             <a class="dropdown-item" href="#" 
                                onclick="event.preventDefault();
                                              document.getElementById('del-material-temp').submit();">
                                Удалить временно
                                <form id="del-material-temp" action="/material/{{ $material->id }}/delete/temp" method="POST" style="display: none;">
                                    @csrf
                                </form>
                             </a>
                        </div>
                    </div>
                    @endcan
                </div>
            </div>
            <p class="material__tags">
                <a href="/material/filter/specialty/{{ $specialty->id }}" class="badge badge-primary p-2" data-toggle="tooltip" data-placement="bottom" title="Специальность">{{ $specialty->name }}</a>
                <a href="/material/filter/subject/{{ $subject->id }}" class="badge badge-primary p-2" data-toggle="tooltip" data-placement="bottom" title="Дисциплина">{{ $subject->name }}</a>
                <a href="/material/filter/type/{{ $type->id }}" class="badge badge-info p-2" data-toggle="tooltip" data-placement="bottom" title="Тип материала">{{ $type->name }}</a>
                <span class="ml-1 badge p-2 {{ $material->status == 'new' ? 'badge-success' : 'badge-primary' }}" data-toggle="tooltip" data-placement="right" title="Статус материала">
                    @if ($material->status == 'new')
                    Новый
                    @elseif ($material->status == 'updated')
                    Обновлен
                    @else
                    Восстановлен
                    @endif
                </span>
            </p>
            <p class="material__desc pt-4 pb-2">
                {{ $material->description }}
            </p>
            <div class="material__content mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="w-25">
                        <h4>Оценка: <span class="badge badge-pill badge-primary font-weight-bold">{{ $material->rate }}</span></h4>
                    </div>
                    <a href="/material/{{ $material->id }}/download" class="btn btn-primary"><i class="fa fa-download mr-2"></i>Скачать</a>
                </div>
            </div>
            <div class="material__comments">
                <div class="d-flex justify-content-between align-items-center border-bottom position-relative">
                    <h2 class="h2 mb-0">
                        Отзывы <span class="text-secondary ml-2">({{ $comments->count() }})</span>
                    </h2>
                    <div class="text-center">
                        {{ $comments->where('review', 'like')->count() }} положительных / {{ $comments->where('review', 'dislike')->count() }} отрицательных
                        <div class="material__rate d-flex mt-3" title="{{ $comments->where('review', 'like')->count()}} / {{ $comments->where('review', 'dislike')->count()}}">
                            @if ($comments->count() > 0)
                            <div class="material__rate-positive bg-primary text-white pl-1 text-center" style="width: {{ ($comments->where('review', 'like')->count() * 100) / $comments->count() }}%"></div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="material__add-comment">
                    @can ('create-material-comment', $material)
                    <form action="/material/{{ $material->id }}/comment" method="POST" class="js-review-field">
                        @csrf
                        <textarea name="description" id="commentDescription" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" cols="30" rows="4" placeholder="Что думаете по этому поводу?"></textarea>
                        @if ($errors->has('description'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary mt-2">Оставить отзыв</button>
                            <div class="col-4 py-2 align-middle">
                                <div class="custom-control custom-radio d-inline-block">
                                    <input type="radio" class="custom-control-input{{ $errors->has('review') ? ' is-invalid' : '' }}" name="review" id="reviewLike" required value="like">
                                    <label class="custom-control-label" for="reviewLike">Интересно <i class="fa fa-smile ml-2"></i></label>
                                </div>
                                <div class="custom-control custom-radio mb-3 d-inline-block">
                                    <input type="radio" class="custom-control-input{{ $errors->has('review') ? ' is-invalid' : '' }}" name="review" id="reviewDisike" required value="dislike">
                                    <label class="custom-control-label" for="reviewDisike">Не интересно <i class="fa fa-frown ml-2"></i></label>
                                    @if ($errors->has('review'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('review') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                @can ('moderate', Auth::user())
                                @if ($comments->count() > 0)
                                <a href="/material/{{ $material->id }}/comment/delete" class="btn btn-danger">Удалить все</a>
                                @endif
                                @endcan
                            </div>
                        </div>
                        <input type="hidden" name="material_id" value="{{ $material->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    </form>
                    @endcan
                </div>
                @forelse($comments as $comment)
                <div class="material-comment border-bottom">
                    <div class="d-flex justify-content-between py-4 align-items-center">
                        <div class="material__author text-center">
                            @if ($comment->user_photo != null)
                            <img src="{{ asset('storage/userdata/' . $comment->user_login . '/' . $comment->user_photo) }}" alt="user photo" class="d-block w-100 m-auto">
                            @else
                            <img src="{{ asset('storage/default.png') }}" alt="photo" class="w-100">
                            @endif
                            <div class="material__user-mark" data-toggle="tooltip" data-placement="top" title="Рейтинг пользователя">
                                {{ $comment->user_rate }}
                            </div>
                            <div class="my-3">
                                <a href="/user/{{ $comment->user_login }}">{{ $comment->user_name }}</a>
                            </div>
                        </div>
                        <div class="col-lg-10 pl-4">
                            <div class="text-secondary mb-2">
                                <!--<span class="badge badge-light">Создано материалов: </span> 
                                <span class="badge badge-light">Отзывов: </span> -->
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="material-comment__content {{ $comment->user_login === $user->login ? 'font-weight-bold' : '' }}">
                                    <div class="mb-3">{{ $comment->description }}</div>
                                    <div class="review">
                                        <i class="fa fa-2x py-2 {{ $comment->review === 'like' ? 'fa-thumbs-up text-success' : 'fa-thumbs-down text-danger' }}"></i>
                                    </div>
                                </div>
                                <div class="material__date text-secondary">
                                    {{ $comment->date }}
                                    @can('moderate', Auth::user())
                                    <div class="material__delete mt-2 text-right">
                                    <a href="#" class="btn btn-danger" onclick="event.preventDefault();
                                    document.getElementById('comment-delete').submit();"><i class="fa fa-close mr-2"></i>Удалить</a>
                                    <form id="comment-delete" action="/material/{{ $material->id }}/comment/{{ $comment->id }}/delete" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    </div>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-secondary d-flex align-items-center justify-content-center py-4">
                    Добавьте свой отзыв первым!
                </div>
                @endforelse
            </div>
        </div>
    </div>
    @else
    <div class="card">
        <div class="card-body">
            {{ $error }}
        </div>
    </div>
    @endif
</div>
@endsection