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
}
