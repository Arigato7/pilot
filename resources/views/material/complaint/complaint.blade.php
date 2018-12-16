@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1 mb-4">Подача жалобы на материал</h1>
    <div class="card complaint">
        <div class="card-header">Подача жалобы на материал  - {{ $material->name }}</div>
        <div class="card-body">
            <form action="{{ route('materials.complaint.store') }}" method="POST" name="createMaterialComplaint">
                @csrf
                <label for="complaintDescription" class="col-form-label text-secondary">Подробности</label>
                <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }} mb-2" name="description" id="complaintDescription" cols="30" rows="10" placeholder="Пожалуйста, опишите причину жалобы" required></textarea>
                @if ($errors->has('description'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
                <input type="hidden" name="material_id" value="{{ $material->id }}">
                <button type="submit" class="btn btn-danger">Подать жалобу</button>
                <a href="{{ route('materials.show', ['id'=>$material->id]) }}" class="btn btn-primary">Отмена</a>
            </form>
        </div>
    </div>
</div>
@endsection