<?php

namespace App\Models;

use App\Data;

class ProductCategory extends Model
{
    protected $table =  "product_categories";

    public function products()
    {
        return Product::where([['category_id', $this->id]]);
    }
    
    public function user()
    {
        return User::find($this->user_id);
    }
}
