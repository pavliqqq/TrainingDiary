<?php

use App\Http\Controllers\workout\WorkoutController;
use App\Http\Controllers\exercise\ExerciseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/workouts', [WorkoutController::class, 'index']);
Route::get('/exercises', [ExerciseController::class, 'index']);

