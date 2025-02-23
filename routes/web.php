<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\workout\WorkoutController;
use App\Http\Controllers\exercise\ExerciseController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/exercises/create', [ExerciseController::class, 'create'])->name('exercise.create');
    Route::get('/exercises/{exercise}/edit', [ExerciseController::class, 'edit'])->name('exercise.edit');
    Route::patch('/exercises/{exercise}', [ExerciseController::class, 'update'])->name('exercise.update');
    Route::delete('/exercises/{exercise}', [ExerciseController::class, 'destroy'])->name('exercise.delete');

});
    Route::group(['namespace' => 'App\Http\Controllers\workout'],function (){
        Route::get('/workouts', [WorkoutController::class, 'index'])->name('workout.index');
        Route::get('/workouts/create', [WorkoutController::class, 'create'])->name('workout.create');

        Route::Post('/workouts', [WorkoutController::class, 'store'])->name('workout.store');
        Route::get('/workouts/{workout}', [WorkoutController::class, 'show'])->name('workout.show');
        Route::get('/workouts/{workout}/edit', [WorkoutController::class, 'edit'])->name('workout.edit');
        Route::patch('/workouts/{workout}', [WorkoutController::class, 'update'])->name('workout.update');
        Route::delete('/workouts/{workout}', [WorkoutController::class, 'destroy'])->name('workout.delete');
    });
    Route::group(['namespace' => 'App\Http\Controllers\exercise'],function () {
        Route::get('/exercises', [ExerciseController::class, 'index'])->name('exercise.index');

        Route::Post('/exercises', [ExerciseController::class, 'store'])->name('exercise.store');
        Route::get('/exercises/{exercise}', [ExerciseController::class, 'show'])->name('exercise.show');
});

require __DIR__.'/auth.php';
