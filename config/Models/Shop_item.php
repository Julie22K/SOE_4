<?php

namespace App\Models;

use App\Data;

class ShopItem
{
    public $id;
    public $table = "shop_items";
    public $ingredient_id;
    public $product_id;
    public $dish_id;
    public $is_exists;
    public $price;
    function __construct($ingredient_id, $product_id, $dish_id, $is_exists, $price, $id = null)
    {
        $this->id = $id;
        $this->ingredient_id = $ingredient_id;
        $this->product_id = $product_id;
        $this->dish_id = $dish_id;
        $this->is_exists = $is_exists;
        $this->price = $price;
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
    static function find($id)
    {
        $shop_item = Data::getItemById('shop_items', $id);
        return new ShopItem($shop_item[1], $shop_item[2], $shop_item[3], $shop_item[4], $shop_item[5], $shop_item[0]);
    }
    static function where($foreign_key, $id)
    {
        $items = Data::getData("shop_items", ' ' . $foreign_key . '=' . $id);
        $res = array();
        foreach ($items as $item) {
            array_push($res, Self::find($item[0]));
        }
        return $res;
    }
    static function all()
    {
        $shop_items = Data::getData('shop_items');
        $res = array();
        foreach ($shop_items as $shop_item) {
            array_push($res, Self::find($shop_item[0]));
        }
        return $res;
    }
    public function create()
    {
        Data::createItem('shop_items', ['ingredient_id' => $this->ingredient_id, 'product_id' => $this->product_id, 'dish_id' => $this->dish_id, 'is_exists' => $this->is_exists]);
    }
    static function store($data)
    {
        Data::createItem('shop_items', $data);
    }
    public function delete()
    {
        Data::deleteItem($this->table, $this->id);
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
