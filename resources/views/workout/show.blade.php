@extends('layouts.main')
@section('content')
    <style>
        .exercise-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
        }

        .exercise-item {
            width: 23%; /* Четыре элемента в строке */
            text-align: center;
        }

        .exercise-item img {
            width: 100%;
            height: 150px; /* Фиксированная высота */
            object-fit: cover; /* Обрезка без искажений */
            border-radius: 8px; /* Скругление углов */
        }
    </style>


    <div>
        <div><a href="#">{{ $workout->id . '. ' . $workout->date }}</a></div>
    </div>

    <div class="exercise-container">
        @foreach($workout->exercises as $exercise)
            <div class="exercise-item">
                <a href="{{route('exercise.show', $exercise->id)}}"><img src="{{ asset($exercise->image) }}" alt = ""></a>
                <a href="{{route('exercise.show', $exercise->id)}}">{{ $exercise->name }}</a>
            </div>
        @endforeach
    </div>

    <div class="d-inline-flex">
        <a href="{{route('workout.edit',$workout->id)}}" class="btn btn-info mt-3">Edit</a>
        <form action="{{route('workout.delete',$workout->id)}}" method="post">
            @csrf
            @method('delete')
            <input type="submit" value="Delete" class="btn btn-danger mt-3">
        </form>
    </div>
    <div>
        <a href="{{route('workout.index')}}" class="btn btn-secondary mt-3">Back</a>
    </div>
@endsection
