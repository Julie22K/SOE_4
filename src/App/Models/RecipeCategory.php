<?php

namespace App\Models;

use App\Data;

class RecipeCategory extends Model
{
    protected $table = 'recipe_categories';

    public function recipes()
    {
        return Recipe::where([['category_id', $this->id]]);
    }
    
    public function user()
    {
        return User::find($this->user_id);
    }
}

