<?php

namespace App\Http\Controllers\workout;

use App\Models\exercise;
use App\Models\ExerciseWorkout;
use App\Models\workout;
use Illuminate\Http\Request;

class WorkoutController
{
    public function index()
    {
        $workouts = auth()->user()->workouts()->orderBy('date', 'desc')->paginate(6);
        return view('workout.index',compact('workouts'));
    }

    public function create(){
        $exercises = exercise::all();
        return view('workout.create', compact('exercises'));
    }

    public function store(Request $request){
        $request->validate([
            'date' => 'required|date',
            'notes' => 'nullable|string',
            'exercises' => 'required|array',
            'exercises.*.id' => 'exists:exercises,id',
            'exercises.*.sets' => 'required|integer|min:1',
            'exercises.*.reps' => 'required|integer|min:1',
            'exercises.*.weight' => 'nullable|numeric|min:0',
        ]);

        $workout = Workout::create([
            'date' => $request->date,
            'notes' => $request->notes,
            'user_id' => auth()->id(),
        ]);

        foreach ($request->exercises as $exercise) {
            ExerciseWorkout::create([
                'workout_id' => $workout->id,
                'exercise_id' => $exercise['id'],
                'sets' => $exercise['sets'],
                'reps' => $exercise['reps'],
                'weight' => $exercise['weight'] ?? null,
            ]);
        }

        return redirect()->route('workout.index')->with('success','Тренировка успешно создана');
    }

    public function show(workout $workout){
        $exercises = exercise::all();
        $workout->load('exercises');

        return view('workout.show',compact ('workout','exercises'));
    }

    public function edit(workout $workout){
        $exercises = exercise::all();
        $workout->load('exercises');
        return view('workout.edit',compact ('workout','exercises'));
    }

    public function update(Request $request, workout $workout){
        $request->validate([
            'date' => 'required|date',
            'notes' => 'nullable|string',
            'exercises' => 'required|array',
            'exercises.*.id' => 'exists:exercises,id',
            'exercises.*.sets' => 'required|integer|min:1',
            'exercises.*.reps' => 'required|integer|min:1',
            'exercises.*.weight' => 'nullable|numeric|min:0'
        ]);

        $workout->update([
            'date' => $request->date,
            'notes' => $request->notes
        ]);


        $syncData = [];

        foreach ($request->exercises as $exerciseId => $exercise) {
            $syncData[$exerciseId] = [
                'sets' => $exercise['sets'] ?? 0,
                'reps' => $exercise['reps'] ?? 0,
                'weight' => $exercise['weight'] ?? null,
            ];
        }

        $workout->exercises()->sync($syncData);

        return redirect()->route('workout.show',$workout->id);
    }

    public function destroy(workout $workout){
        $workout -> delete();
        return redirect()->route('workout.index');
    }
}
