@extends('layouts.main')
@section('content')
    <div>
        <a href="{{route('exercise.create')}}" class="btn btn-success m-3">Add new</a>
    </div>
    <div>
        @foreach($exercises as $exercise)
            <div><a href="{{route('exercise.show', $exercise->id)}}">{{ $exercise->id . '. ' . $exercise->name }}</a>
            </div>
        @endforeach
    </div>
@endsection
