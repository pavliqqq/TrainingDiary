@extends('layouts.main')
@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Мои тренировки</h2>
            <a href="{{ route('workout.create') }}" class="btn btn-success">Добавить тренировку</a>
        </div>

        @if($workouts->count() > 0)
            <div class="row">
                @foreach($workouts as $workout)
                    <div class="col-md-4">
                        <div class="card mb-3 shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title">Тренировка #{{ $workout->id }}</h5>
                                <p class="card-text text-muted">
                                    📅 Дата: <strong>{{ \Carbon\Carbon::parse($workout->date)->format('d.m.Y') }}</strong>
                                </p>
                                <a href="{{ route('workout.show', $workout->id) }}" class="btn btn-primary">Подробнее</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Пагинация -->
            <div class="d-flex justify-content-center mt-3">
                {{ $workouts->links() }}
            </div>
        @else
            <div class="alert alert-warning text-center">Тренировок пока нет. Добавьте первую!</div>
        @endif
    </div>

@endsection
