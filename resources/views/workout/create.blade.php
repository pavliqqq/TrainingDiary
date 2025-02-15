@extends('layouts.main')
@section('content')
    <div>
        <form action="{{route('workout.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Date</label>
                <input
                    value="{{old('date')}}"

                    type="date" name="date" class="form-control" id="date" placeholder="Date">
                @error('date')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea type="text" name="notes" class="form-control" id="notes"
                          placeholder="Notes">{{old('notes')}}</textarea>
                @error('notes')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            <h3>Упражнения:</h3>
            <div id="exercise-list">
                <div class="exercise">
                    <select name="exercises[0][id]" required>
                        @foreach ($exercises as $exercise)
                            <option value="{{ $exercise->id }}">{{ $exercise->name }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="exercises[0][sets]" placeholder="Подходы" required>
                    <input type="number" name="exercises[0][reps]" placeholder="Повторения" required>
                    <input type="number" name="exercises[0][weight]" placeholder="Вес (кг)">
                    <button type="button" onclick="removeExercise(this)">Удалить</button>
                </div>
            </div>

            <button type="button" onclick="addExercise()">Добавить упражнение</button>
            <button type="submit" class="btn btn-primary mt-3">Create</button>
        </form>
    </div>

    <script>
        let index = 1;
        function addExercise() {
            let div = document.createElement('div');
            div.className = 'exercise';
            div.innerHTML = `
            <select name="exercises[${index}][id]" required>
                @foreach ($exercises as $exercise)
            <option value="{{ $exercise->id }}">{{ $exercise->name }}</option>
                @endforeach
            </select>
            <input type="number" name="exercises[${index}][sets]" placeholder="Подходы" required>
            <input type="number" name="exercises[${index}][reps]" placeholder="Повторения" required>
            <input type="number" name="exercises[${index}][weight]" placeholder="Вес (кг)">
            <button type="button" onclick="removeExercise(this)">Удалить</button>
        `;
            document.getElementById('exercise-list').appendChild(div);
            index++;
        }
        function removeExercise(button) {
            const exercises = document.querySelectorAll(".exercise");
            if (exercises.length > 1)
                button.parentElement.remove();
        }
    </script>
@endsection
