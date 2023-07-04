<?php

namespace App\Models;

use App\Data;
use DateTime;

class Person
{
    public $id;
    public $table = "persons";
    public $name;
    public $gender;
    public $date_of_birth;
    public $weight;
    public $height;
    public $activity;
    public $person_data;
    function __construct($name, $gender, $date_of_birth, $weight, $height, $activity, $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->gender = $gender;
        $this->date_of_birth = $date_of_birth;
        $this->weight = $weight;
        $this->height = $height;
        $this->activity = $activity;
        $this->person_data = $this->person_data();
    }
    function person_data()
    {
        $kcal = $this->calcKcalNorm($this->weight, $this->height, $this->gender, $this->activity);
        $res = array('kcal' => $kcal, 'fat' => $this->calcFatNorm($kcal), 'protein' => $this->calcProteinNorm($kcal), 'carb' => $this->calcCarbNorm($kcal), 'cellulose' => $this->calcCelluloseNorm($kcal), 'water' => $this->calcWaterNorm($this->weight), 'vitA' => 900, 'vitE' => 15, 'vitK' => 100, 'vitD' => 10, 'vitC' => 70, 'om3' => round(0.06 * $kcal, 2), 'om6' => round(0.015 * $kcal, 2), 'vitB1' => 1.3, 'vitB2' => 1.5, 'vitB5' => 4, 'vitB6' => 1.6, 'vitB8' => 1000, 'vitB9' => 400, 'vitB12' => 3, 'minMg' => 400, 'minNa' => 1300, 'minCa' => 2300, 'minCl' => 1200, 'minK' => 2500, 'minS' => 4, 'minP' => 1200, 'minCr' => 1000, 'minI' => 150, 'minCu' => 35,);
        return $res;
    }
    function calcKcalNorm($weight, $height, $gender, $activity)
    {
        $age = $this->age();
        $calorieNorm = 0;
        $w = (float)$weight;
        $h = (float)$height;
        $a = (float)$age;
        $act = (float)$activity;
        if ($gender === "woman") {
            $calorieNorm = ((10 * $w) + (6.25 * $h) - (5 * $a) - 161) * $act;
        } else {
            $calorieNorm = ((10 * $w) + (6.25 * $h) - (5 * $a) + 5) * $act;
        }
        return round($calorieNorm, 2);
    }
    function age()
    {
        $date = new DateTime($this->date_of_birth);
        $now = new DateTime();
        $interval = $now->diff($date);
        return $interval->y;
    }
    function calcProteinNorm($kcal)
    {
        return round(($kcal * 0.3) / 4, 2);
    }
    function calcFatNorm($kcal)
    {
        return round(($kcal * 0.1) / 9, 2);
    }
    function calcCarbNorm($kcal)
    {
        return round(($kcal * 0.6) / 4, 2);
    }
    function calcCelluloseNorm($kcal)
    {
        return round(0.012 * $kcal, 2);
    }
    function calcWaterNorm($weight)
    {
        return round($weight * 35, 2);
    }
    public function person_in_menus()
    {
        return PersonInMenu::where('person_id', $this->id);
    }
    static function find($id)
    {
        $person = Data::getItemById('persons', $id);
        return new Person($person[1], $person[2], $person[3], $person[4], $person[5], $person[6], $person[0]);
    }
    static function where($foreign_key, $id)
    {
        $items = Data::getData("persons", ' ' . $foreign_key . '=' . $id);
        $res = array();
        foreach ($items as $item) {
            array_push($res, Self::find($item[0]));
        }
        return $res;
    }
    static function all()
    {
        $persons = Data::getData('persons');
        $res = array();
        foreach ($persons as $person) {
            array_push($res, Self::find($person[0]));
        }
        return $res;
    }
    public function create()
    {
        Data::createItem('persons', array_merge(['name' => $this->name, 'gender' => $this->gender, 'date_of_birth' => $this->date_of_birth, 'weight' => $this->weight, 'height' => $this->height, 'activity' => $this->activity], $this->person_data));
    }
    static function store($data)
    {
        $new_person = new Person($data['name'], $data['name'], $data['name'], $data['name'], $data['name'], $data['name']);
        $new_person->create();
    }
    public function delete()
    {
        foreach ($this->person_in_menus() as $person_in_menu) {
            $person_in_menu->delete();
        }
        Data::deleteItem($this->table, $this->id);
    }
}
