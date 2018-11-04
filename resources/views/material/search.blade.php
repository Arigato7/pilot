@extends('layouts.app')

@section('content')
<div class="container">
    <div class="search mb-4">
        <form id="search-material" action="/material/find" method="post">
            @csrf
            <div class="d-flex justify-content-between btn-group">
                <input type="text" id="materialSearch" name="materialName" class="form-control" placeholder="Название материала" required>
                <button type="submit" class="btn btn-primary" style="margin-left: -2px;">Искать</button>
            </div>
            <div class="pl-3 my-2">Например, "регламент межсетевого взаимодействия"</div>
            <div class="search-filter">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="col-4">
                                Оценка: от 
                                <select name="rateFrom" class="form-control d-inline-block w-25" id="searchRateFrom">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                до
                                <select name="rateTo" class="form-control d-inline-block w-25" id="searchRateTo">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <select name="materialType" class="form-control mb-2" id="searchMaterialType">
                                    <option value="#" selected disabled>Тип материала</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <select name="materialSpecialty" class="form-control mb-2" id="searchMaterialSpecialty">
                                    <option value="#" selected disabled>Специальность</option>
                                </select>
                                <select name="materialSubject" class="form-control" id="searchMaterialSubject">
                                    <option value="#" selected disabled>Дисциплина</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card">
        <div class="card-header">Результаты поиска по запросу "{{ $name }}"</div>
        <div class="card-body">
            <div class="pb-4">
                <h4>Найдено материалов {{ $materials->count() }}</h4>
            </div>
            @forelse($materials as $material)
            <div class="material mb-2">
                <div class="d-flex justify-content-between">
                    <div class="col-lg-7 pl-0">
                        @if ($material->status != 'deleted')
                        <a href="/material/{{ $material->id }}" class="material__link">
                            {{ $material->name }}
                            <span class="ml-1 badge {{ $material->status == 'new' ? 'badge-success' : 'badge-primary' }}">
                                @if ($material->status == 'new')
                                Новый
                                @elseif ($material->status == 'updated')
                                Обновлен
                                @endif
                            </span>
                        </a>
                        @else 
                        <a href="#" class="material__link disabled">
                            {{ $material->name }}
                            <span class="ml-1 badge badge-dark">
                                Удален
                            </span>
                        </a>
                        @endif
                        <div class="text-secondary">
                            Оценка - {{ $material->rate }}
                        </div>
                    </div>
                    <div class="material__date text-secondary">
                        {{ $material->date }}
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center text-secondary py-5">
                <p class="h3">Пусто</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection