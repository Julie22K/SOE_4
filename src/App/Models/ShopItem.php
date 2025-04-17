<?php

namespace App\Models;

use App\Data;
/**
 * @property int $ingredient_id
 * @property int $product_id
 * @property int $dish_id
 * @property int $is_exists
 */
class ShopItem extends Model
{
    protected $table =  "shop_items";
   
    static public function shoplist_grouping(array $shoplist){
        $res=array();

        foreach($shoplist as $item){
            array_push($res[$item->product_id]);
        }
        //TODO:



        return $res;
    }
    public function ingredient()
    {
        return Ingredient::find($this->ingredient_id);
    }
    public function product()
    {
        return Product::find($this->product_id);
    }
    public function dish()
    {
        return Dish::find($this->dish_id);
    }
    
    public function check()
    {
        $data_before = $this->is_exists;
        $resp = Data::updateItem("shop_items", $this->id, ["is_exists" => "1"]);
        $data_after = ShopItem::find($this->id);
        return $data_before == $data_after->is_exists ? true : $data_after;
    }
    public function uncheck()
    {
        $data_before = $this->is_exists;
        $resp = Data::updateItem("shop_items", $this->id, ["is_exists" => "0"]);
        $data_after = ShopItem::find($this->id);
        return $data_before == $data_after->is_exists ? true : $data_after;
    }
}
