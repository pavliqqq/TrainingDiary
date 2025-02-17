@extends('layouts.main')
@section('content')

    <style>
        .custom-select {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .selected {
            padding: 10px;
            border: 1px solid #ccc;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .selected img {
            width: 15%;
            height: auto;
            margin-right: 10px;
        }

        .options {
            display: none;
            position: absolute;
            width: 100%;
            border: 1px solid #ccc;
            background: white;
            z-index: 10;
        }

        .option {
            display: flex;
            align-items: center;
            padding: 5px;
            cursor: pointer;
        }

        .option img {
            width: 10%;
            height: auto;
            margin-right: 10px;
        }

        .option:hover {
            background: #eee;
        }
    </style>


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
                    <div class="custom-select mb-3" onclick="toggleDropdown(this)">
                        <div class="selected">Выберите упражнение</div>
                        <div class="options">
                            @foreach ($exercises as $exercise)
                                <div class="option" data-value="{{ $exercise->id }}" data-name="{{ $exercise->name }}"
                                     data-img="{{ asset($exercise->image) }}">
                                    <img src="{{ asset($exercise->image) }}" alt="">{{ $exercise->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <input type="hidden" name="exercises[0][id]" required>
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
            <div class="custom-select" onclick="toggleDropdown(this)">
                <div class="selected">Выберите упражнение</div>
                <div class="options">
                    @foreach ($exercises as $exercise)
            <div class="option" data-value="{{ $exercise->id }}" data-name="{{ $exercise->name }}" data-img="{{ asset($exercise->image) }}">
                        <img src="{{ asset($exercise->image) }}" alt=""> {{ $exercise->name }}
            </div>
@endforeach
            </div>
        </div>
        <input type="hidden" name="exercises[${index}][id]" required>
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

        function toggleDropdown(select) {
            let options = select.querySelector(".options");
            options.style.display = (options.style.display === "block") ? "none" : "block";

            options.querySelectorAll(".option").forEach(option => {
                option.addEventListener("click", function () {
                    let selected = select.querySelector(".selected");
                    selected.innerHTML = `<img src="${this.dataset.img}" alt=""> ${this.dataset.name}`;
                    select.nextElementSibling.value = this.dataset.value;
                    options.style.display = "none";
                });
            });
        }

        document.addEventListener("click", function (e) {
            document.querySelectorAll(".custom-select .options").forEach(options => {
                if (!options.parentElement.contains(e.target)) {
                    options.style.display = "none";
                }
            });
        });
    </script>
@endsection
