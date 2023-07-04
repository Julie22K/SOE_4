<?php

namespace App\Models;

use App\Data;

class MealTime
{
    public $id;
    public $table = "meal_times";
    public $name;
    public $priority;
    public $is_use;
    function __construct($name, $priority, $is_use, $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->priority = $priority;
        $this->is_use = $is_use;
    }
    public function dishes()
    {
        return Dish::where('meal_time_id', $this->id);
    }
    static function find($id)
    {
        $meal_time = Data::getItemById('meal_times', $id);
        return new MealTime($meal_time[1], $meal_time[2], $meal_time[3], $meal_time[0]);
    }
    static function where($foreign_key, $id)
    {
        $items = Data::getData("meal_times", ' ' . $foreign_key . '=' . $id);
        $res = array();
        foreach ($items as $item) {
            array_push($res, Self::find($item[0]));
        }
        return $res;
    }
    static function all()
    {
        $meal_times = Data::getData('meal_times', ' id!=0 AND is_use=true ORDER BY priority;');
        $res = array();
        foreach ($meal_times as $meal_time) {
            array_push($res, Self::find($meal_time[0]));
        }
        return $res;
    }
    public function create()
    {
        Data::createItem('meal_times', ['name' => $this->name]);
    }
    static function store($data)
    {
        Data::createItem('meal_times', $data);
    }
    public function save()
    {
        Data::updateItem($this->table, $this->id, ["name" => $this->name, "priority" => $this->priority, "is_use" => $this->is_use,]);
    }
    static function update($id, $data)
    {
        Data::updateItem('meal_times', $id, $data);
    }
    public function delete()
    {
        foreach ($this->dishes() as $dish) {
            $dish->delete();
        }
        Data::deleteItem($this->table, $this->id);
    }
}
