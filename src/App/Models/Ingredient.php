<?php

namespace App\Models;

use App\Data;
/**
 * @property int $weight
 * @property int $product_id
 */
class Ingredient extends Model
{
    protected $table = 'ingredients';
    
    public function price()
    {
        $avg_price_100g = $this->product()->avg_price();
        return round(($avg_price_100g * $this->weight) / 100, 2);
    }
    public function info()
    {
        $res = [];
        // $info = $this->product()->product_data;
        foreach (Data::$info_data as $val) {
            $res[$val] = ($this->product()->$val * $this->weight) / 100;
        }
        return $res;
    }

    /**
     * 
     */
    public function recipe()
    {
        return Recipe::find($this->recipe_id);
    }
    public function product()
    {
        return Product::find($this->product_id);
    }
    public function shop_items()
    {
        return ShopItem::where([['ingredient_id', $this->id]]);
    }
    
}
