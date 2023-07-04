<?php

namespace App\Models;

use App\Data;

class Manufacturer
{
    public $id;
    public $table = "manufacturers";
    public $name;
    function __construct($name, $id = null)
    {
        $this->id = $id;
        $this->name = $name;
    }
    public function prices()
    {
        return Price::where('manufacturer_id', $this->id);
    }
    static function find($id)
    {
        $manufacturer = Data::getItemById('manufacturers', $id);
        return new Manufacturer($manufacturer[1], $manufacturer[0]);
    }
    static function where($foreign_key, $id)
    {
        $items = Data::getData("manufacturers", ' ' . $foreign_key . '=' . $id);
        $res = array();
        foreach ($items as $item) {
            array_push($res, Self::find($item[0]));
        }
        return $res;
    }
    static function all()
    {
        $manufacturers = Data::getData('manufacturers');
        $res = array();
        foreach ($manufacturers as $manufacturer) {
            array_push($res, Self::find($manufacturer[0]));
        }
        return $res;
    }
    public function create()
    {
        Data::createItem('prices', ['manufacturers' => $this->name]);
    }
    static function store($data)
    {
        Data::createItem('manufacturers', $data);
    }
    public function delete()
    {
        foreach ($this->prices() as $price) {
            $price->delete();
        }
        Data::deleteItem($this->table, $this->id);
    }
}
