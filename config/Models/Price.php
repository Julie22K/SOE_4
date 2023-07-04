<?php

namespace App\Models;

use App\Data;

class Price
{
    public $id;
    public $table = "prices";
    public $price;
    public $weight;
    public $product_id;
    public $shop_id;
    public $manufacturer_id;
    function __construct($price, $weight, $product_id, $shop_id, $manufacturer_id, $id = null)
    {
        $this->id = $id;
        $this->price = $price;
        $this->weight = $weight;
        $this->product_id = $product_id;
        $this->shop_id = $shop_id;
        $this->manufacturer_id = $manufacturer_id;
    }
    public function shop()
    {
        return Shop::find($this->shop_id);
    }
    public function manufacturer()
    {
        return Manufacturer::find($this->manufacturer_id);
    }
    public function product()
    {
        return Product::find($this->product_id);
    }
    static function find($id)
    {
        $price = Data::getItemById('prices', $id);
        return new Price($price[1], $price[2], $price[3], $price[4], $price[5], $price[0]);
    }
    static function where($foreign_key, $id)
    {
        $items = Data::getData("prices", ' ' . $foreign_key . '=' . $id);
        $res = array();
        foreach ($items as $item) {
            array_push($res, Self::find($item[0]));
        }
        return $res;
    }
    static function all()
    {
        $prices = Data::getData('prices');
        $res = array();
        foreach ($prices as $price) {
            array_push($res, Self::find($price[0]));
        }
        return $res;
    }
    public function create()
    {
        Data::createItem('prices', ['price' => $this->price, 'weight' => $this->weight, 'product_id' => $this->product_id, 'shop_id' => $this->shop_id, 'manufacturer_id' => $this->manufacturer_id,]);
    }
    static function store($data)
    {
        Data::createItem('prices', $data);
    }
    public function delete()
    {
        Data::deleteItem($this->table, $this->id);
    }
}
