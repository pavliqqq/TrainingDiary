@extends('layouts.main')
@section('content')
    <div class="container mt-4">
        <!-- Заголовок тренировки -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Тренировка #{{ $workout->id }}</h2>
            <span class="text-muted">📅 {{ \Carbon\Carbon::parse($workout->date)->format('d.m.Y') }}</span>
        </div>

        <!-- Вывод категорий упражнений -->
        @php
            $categories = $workout->exercises->pluck('category')->unique();
        @endphp
        <div class="mb-3">
            <strong>Категории упражнений:</strong>
            <span class="badge bg-primary">{{ $categories->implode('</span> <span class="badge bg-primary">') }}</span>
        </div>

        <!-- Упражнения -->
        @if($workout->exercises->count() > 0)
            <div class="row">
                @foreach($workout->exercises as $exercise)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card mb-3 shadow-sm">
                            <a href="{{ route('exercise.show', $exercise->id) }}">
                                <img src="{{ asset($exercise->image) }}" class="card-img-top workout-img" alt="{{ $exercise->name }}">
                            </a>
                            <div class="card-body text-center">
                                <span class="badge bg-secondary">{{ $exercise->category }}</span>
                                <a href="{{ route('exercise.show', $exercise->id) }}" class="fw-bold d-block mt-1">{{ $exercise->name }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-warning text-center">Нет добавленных упражнений.</div>
        @endif

        <!-- Кнопки управления -->
        <div class="d-flex gap-2 mt-3">
            <a href="{{ route('workout.edit', $workout->id) }}" class="btn btn-info">✏️ Редактировать</a>

            <form action="{{ route('workout.delete', $workout->id) }}" method="post" onsubmit="return confirm('Удалить тренировку?');">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">🗑️ Удалить</button>
            </form>

            <a href="{{ route('workout.index') }}" class="btn btn-secondary">🔙 Назад</a>
        </div>
    </div>

    <!-- Стилизация картинок -->
    <style>
        .workout-img {
            width: 100%;
            height: 180px; /* Фиксированная высота */
            object-fit: cover; /* Обрезка без искажений */
            border-radius: 8px;
        }
    </style>

@endsection
