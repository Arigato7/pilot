@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Специальности
        </div>
        <div class="card-body">
            На данный момент добавлены следующие специальности:
            <ul class="w-50 mx-auto my-4 list-group list-group-flush">
                @forelse ($specialtyTypes as $specialtyType)
                <li class="list-group-item">
                    {{ $specialtyType->name }}
                    <ul class="list-group list-group-flush">
                        @forelse ($specialties as $specialty)
                        @if ($specialty->specialty_type_id == $specialtyType->id)
                        <li class="list-group-item">
                            {{ $specialty->name }}
                        </li>
                        @endif
                        @empty
                        <li>Добавьте специальностей</li>
                        @endforelse
                    </ul>
                </li>
                @empty
                <li>Добавьте группы специальностей</li>
                @endforelse
            </ul>
            <div class="mt-2">Первый уровень списка представляет собой название группы специальностей.</div>
            <div class="mt-2">В дальнейшем планируется улучшение пользовательского интерфейса, в плане взаимодействия с объектами системы (добавление, удаление, редактирование и так далее).</div>
        </div>
    </div>
</div>
@endsection