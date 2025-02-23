<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exercise_workouts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('exercise_id');
            $table->unsignedBigInteger('workout_id');
            $table->unsignedSmallInteger('sets');
            $table->unsignedMediumInteger('reps');
            $table->decimal('weight')->nullable();

            $table->index('exercise_id', 'exercise_workout_exercise_idx');
            $table->index('workout_id', 'exercise_workout_workout_idx');

            $table->foreign('exercise_id', 'exercise_workout_exercise_fk')->on('exercises')->references('id');
            $table->foreign('workout_id', 'exercise_workout_workout_fk')->on('workout')->references('id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_workouts');
    }
};
