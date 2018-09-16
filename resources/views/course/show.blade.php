@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card course">
        <div class="card-header">
            {{ $course->name }}
        </div>
        <div class="card-body">
            Дата начала {{ $course->start_date }} <br>
            Дата завершения {{ $course->end_date }}
        </div>
    </div>
</div>
@endsection