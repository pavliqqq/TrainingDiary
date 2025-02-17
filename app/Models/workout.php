<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class workout extends Model
{
    protected $guarded;

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class, 'exercise_workouts', 'workout_id', 'exercise_id')
            ->withPivot('sets', 'reps', 'weight');
    }
}
