<?php

namespace App\Models;

use App\Data;

class Manufacturer extends Model
{
    protected $table = 'manufacturers';
    
    public function prices()
    {
        return Price::where([['manufacturer_id', $this->id]]);
    }
    
    public function user()
    {
        return User::find($this->user_id);
    }
}
