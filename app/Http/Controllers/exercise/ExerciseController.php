<?php

namespace App\Http\Controllers\exercise;

use App\Models\exercise;

class ExerciseController
{
    public function index()
    {
        $exercises = exercise::all();
        return view('exercise.index',compact('exercises'));
    }

    public function create(){
        return view('exercise.create');
    }

    public function store(){
        $data = request()->validate([
           'name' => 'required | string',
            'category' => 'required | string'
        ]);
        exercise::create($data);
        return redirect()->route('exercise.index');
    }

    public function show(exercise $exercise){
        return view('exercise.show',compact ('exercise'));
    }

    public function edit(exercise $exercise){
        return view('exercise.edit',compact ('exercise'));
    }

    public function update(exercise $exercise){
        $data = request()->validate([
            'name' => 'string',
            'category' => 'string'
        ]);
        $exercise->update($data);
        return redirect()->route('exercise.show',$exercise->id);
    }

    public function destroy(exercise $exercise){
        $exercise -> delete();
        return redirect()->route('exercise.index');
    }
}
