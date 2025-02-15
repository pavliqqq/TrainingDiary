<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class workout extends Model
{
    protected $guarded;

    public function exercise()
    {
        return $this->belongsToMany(exercise::class,'workout_workouts', 'workout_id', 'exercise_id');
    }
}
