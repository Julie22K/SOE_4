<?php

namespace App\Models;

use App\Data;

class MealTime extends Model
{
    protected $table = 'meal_times';
    
    public function dishes()
    {
        return Dish::where([['meal_time_id', $this->id]]);
    }
    
    public function user()
    {
        return User::find($this->user_id);
    }
}
