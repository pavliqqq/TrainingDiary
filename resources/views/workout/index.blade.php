@extends('layouts.main')
@section('content')
    <div>
        <a href="{{route('workout.create')}}" class="btn btn-success m-3">Добавить тренировку</a>
    </div>
    <div>
        @foreach($workouts as $workout)
            <div><a href="{{route('workout.show', $workout->id)}}">{{ $workout->id . '. ' . $workout->date }}</a>
            </div>
        @endforeach
    </div>
@endsection
