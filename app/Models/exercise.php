<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class exercise extends Model
{
    protected $guarded;

    public function workout()
    {
        return $this->belongsToMany(Workout::class, 'exercise_workouts', 'exercise_id', 'workout_id');
    }
}
