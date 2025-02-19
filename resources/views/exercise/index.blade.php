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
        <a href="{{route('exercise.create')}}" class="btn btn-success m-3">Add new</a>
    </div>
    <div>
        <div class="exercise-container">
            @foreach($exercises as $exercise)
                <div class="exercise-item">
                    <a href="{{route('exercise.show', $exercise->id)}}"><img src="{{ asset($exercise->image) }}" alt=""></a>
                    <a href="{{route('exercise.show', $exercise->id)}}">{{ $exercise->id . '. ' . $exercise->name }}</a>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            {{ $exercises->links() }}
        </div>
    </div>
@endsection
