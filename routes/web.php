<?php

use App\Http\Controllers\workout\WorkoutController;
use App\Http\Controllers\exercise\ExerciseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'App\Http\Controllers\workout'],function (){
    Route::get('/workouts', [WorkoutController::class, 'index']);
    Route::get('/workouts/create', [WorkoutController::class, 'create']);
});
Route::group(['namespace' => 'App\Http\Controllers\exercise'],function () {
    Route::get('/exercises', [ExerciseController::class, 'index']);
    Route::get('/exercises/create', [ExerciseController::class, 'create']);
});

