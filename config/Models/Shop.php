<?php

namespace App\Models;

use App\Data;

class Shop
{
    public $id;
    public $table = "shops";
    public $name;
    public $address;
    public $phone;
    function __construct($name, $address, $phone, $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->phone = $phone;
    }
    public function prices()
    {
        return Price::where('shop_id', $this->id);
    }
    static function find($id)
    {
        $shop = Data::getItemById('shops', $id);
        return new Shop($shop[1], $shop[2], $shop[3], $shop[0]);
    }
    static function where($foreign_key, $id)
    {
        $items = Data::getData("shops", ' ' . $foreign_key . '=' . $id);
        $res = array();
        foreach ($items as $item) {
            array_push($res, Self::find($item[0]));
        }
        return $res;
    }
    static function all()
    {
        $shops = Data::getData('shops');
        $res = array();
        foreach ($shops as $shop) {
            array_push($res, Shop::find($shop[0]));
        }
        return $res;
    }
    public function create()
    {
        Data::createItem('shops', ['name' => $this->name, 'address' => $this->address, 'phone' => $this->phone]);
    }
    static function store($data)
    {
        Data::createItem('shops', $data);
    }
    public function delete()
    {
        foreach ($this->prices() as $price) {
            $price->delete();
        }
        Data::deleteItem($this->table, $this->id);
    }
}
