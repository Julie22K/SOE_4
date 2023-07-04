<?php

namespace App\Models;

use App\Data;

class Ingredient
{
    public $id;
    public $table = "ingredients";
    public $weight;
    public $product_id;
    public $recipe_id;
    function __construct($weight, $recipe_id, $product_id, $id = null)
    {
        $this->id = $id;
        $this->weight = $weight;
        $this->product_id = $product_id;
        $this->recipe_id = $recipe_id;
    }
    public function price()
    {
        $avg_price_100g = $this->product()->avg_price();
        return round(($avg_price_100g * $this->weight) / 100, 2);
    }
    public function info()
    {
        $res = [];
        $info = $this->product()->product_data;
        foreach (Data::$info_data as $val) {
            $res[$val] = ($info[$val] * $this->weight) / 100;
        }
        return $res;
    }
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
        return ShopItem::where('ingredient_id', $this->id);
    }
    static function find($id)
    {
        $ingredient = Data::getItemById('ingredients', $id);
        return new Ingredient($ingredient[1], $ingredient[2], $ingredient[3], $ingredient[0]);
    }
    static function where($foreign_key, $id)
    {
        $items = Data::getData("ingredients", ' ' . $foreign_key . '=' . $id);
        $res = array();
        foreach ($items as $item) {
            array_push($res, Self::find($item[0]));
        }
        return $res;
    }
    static function all()
    {
        $ingredients = Data::getData('ingredients');
        $res = array();
        foreach ($ingredients as $ingredient) {
            array_push($res, Self::find($ingredient[0]));
        }
        return $res;
    }
    public function create()
    {
        Data::createItem('ingredients', ['weight' => $this->weight, 'product_id' => $this->product_id, 'recipe_id' => $this->recipe_id]);
    }
    static function store($data)
    {
        Data::createItem('ingredients', $data);
    }
    public function delete()
    {
        foreach ($this->shop_items() as $shop_item) {
            $shop_item->delete();
        }
        Data::deleteItem($this->table, $this->id);
    }
}
