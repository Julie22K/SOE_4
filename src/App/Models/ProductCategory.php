<?php

namespace App\Models;

use App\Data;

class ProductCategory
{
    public $id;
    public $table = "product_categories";
    public $name;
    function __construct($name, $id = null)
    {
        $this->id = $id;
        $this->name = $name;
    }
    public function products()
    {
        return Product::where('category_id', $this->id);
    }
    static function find($id)
    {
        $product_category = Data::getItemById('product_categories', $id);
        return new ProductCategory($product_category[1], $product_category[0]);
    }
    static function where($foreign_key, $id)
    {
        $items = Data::getData("product_categories", ' ' . $foreign_key . '=' . $id);
        $res = array();
        foreach ($items as $item) {
            array_push($res, Self::find($item[0]));
        }
        return $res;
    }
    static function all()
    {
        $product_categories = Data::getData('product_categories');
        $res = array();
        foreach ($product_categories as $product_category) {
            array_push($res, Self::find($product_category[0]));
        }
        return $res;
    }
    public function create()
    {
        Data::createItem('product_categories', ['name' => $this->name]);
    }
    static function store($data)
    {
        Data::createItem('product_categories', $data);
    }
    public function delete()
    {
        Data::deleteItem($this->table, $this->id);
    }
}
