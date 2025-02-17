@extends('layouts.main')
@section('content')

    <div>
        <form action="{{route('workout.update',$workout->id) }}" method="post">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="date">Date</label>
                <input
                    value="{{ $workout->date }}"

                    type="date" name="date" class="form-control" id="date" placeholder="Date">
                @error('date')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea type="text" name="notes" class="form-control" id="notes"
                          placeholder="Notes">{{ $workout->notes }}</textarea>
                @error('notes')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <table border="1" class="table mt-3">
                <thead>
                <tr>
                    <th>Название упражнения</th>
                    <th>Картинка</th>
                    <th>Подходы</th>
                    <th>Повторения</th>
                    <th>Вес(кг)</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody id="exercise-table">
                @foreach ($workout->exercises as $exercise)
                    <tr>
                        <td>{{ $exercise->name }}</td>
                        <td><img src="{{ asset($exercise->image) }}" alt="{{ $exercise->name }}" width="100"></td>
                        <td><input value="{{ $exercise->pivot->sets }}" type="number" name="exercises[{{ $exercise->id }}][sets]" placeholder="Подходы"></td>
                        <td><input value="{{ $exercise->pivot->reps }}" type="number" name="exercises[{{ $exercise->id }}][reps]" placeholder="Повторения"></td>
                        <td><input value="{{ $exercise->pivot->weight }}" type="number" name="exercises[{{ $exercise->id }}][weight]" placeholder="Вес(кг)"></td>
                        <td>
                            <button type="button" class="btn btn-danger" onclick="removeRow(this)">Удалить</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="form-group">
                <label for="new-exercise">Добавить упражнение:</label>
                <select id="new-exercise" class="form-control">
                    <option value="">Выберите упражнение</option>
                    @foreach ($exercises as $exercise)
                        <option data-name="{{ $exercise->name }}" data-img="{{ asset($exercise->image) }}" value="{{ $exercise->id }}">
                            {{ $exercise->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="button" onclick="addExercise()">Добавить упражнение</button>
            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>

    <script>
        function addExercise() {
            let select = document.getElementById("new-exercise");
            let selectedOption = select.options[select.selectedIndex];

            if (!selectedOption.value) return; // Если не выбрали, ничего не делаем

            let exerciseId = selectedOption.value;
            let exerciseName = selectedOption.dataset.name;
            let exerciseImg = selectedOption.dataset.img;

            let table = document.getElementById("exercise-table");
            let newRow = document.createElement("tr");

            newRow.innerHTML = `
                <td>${exerciseName}</td>
                <td><img src="${exerciseImg}" alt="${exerciseName}" width="100"></td>
                <td><input type="number" name="exercises[${exerciseId}][sets]" placeholder="Подходы" required></td>
                <td><input type="number" name="exercises[${exerciseId}][reps]" placeholder="Повторения" required></td>
                <td><input type="number" name="exercises[${exerciseId}][weight]" placeholder="Вес (кг)"></td>
                <td>
                    <button type="button" class="btn btn-danger" onclick="removeRow(this)">Удалить</button>
                </td>
            `;

            table.appendChild(newRow);
        }

        function removeRow(button) {
            button.closest("tr").remove();
        }
    </script>
@endsection
