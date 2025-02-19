<?php

namespace App\Http\Controllers\exercise;

use App\Models\exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExerciseController
{
    public function index()
    {
        $exercises = exercise::paginate(8);
        return view('exercise.index',compact('exercises'));
    }

    public function create(){
        return view('exercise.create');
    }

    public function store(Request $request){
        $request->validate([
           'name' => 'required | string',
            'category' => 'required | string',
            'image' => 'required | image | mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $path = $request->file('image')->store('exercises','public');
        exercise::create([
            'name' => $request->name,
            'category' => $request->category,
            'image' => "storage/$path"
        ]);
        return redirect()->route('exercise.index');
    }

    public function show(exercise $exercise){
        return view('exercise.show',compact ('exercise'));
    }

    public function edit(exercise $exercise){
        return view('exercise.edit',compact ('exercise'));
    }

    public function update(Request $request, exercise $exercise){
        $request->validate([
            'name' => 'string',
            'category' => 'string',
            'image' => 'required | image | mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $path = $request->file('image')->store('exercises','public');

        $exercise->update([
            'name' => $request->name,
            'category' => $request->category,
            'image' => "storage/$path"
        ]);
        return redirect()->route('exercise.show',$exercise->id);
    }

    public function destroy(exercise $exercise){
        $exercise -> delete();
        return redirect()->route('exercise.index');
    }
}
