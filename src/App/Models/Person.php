<?php

namespace App\Models;

use App\Data;
use DateTime;

/**
 * @property string $name
 * @property string $gender
 * @property string $date_of_birth
 * @property int $weight
 * @property int $height
 * @property string $activity
 * @property int $user_id
 * @property int $is_private
 * @property int $kcal
 * @property int $water
 * @property int $cellulose
 * @property int $fat
 * @property int $carb
 * @property int $protein
 * @property int $vitA
 * @property int $vitE
 * @property int $vitK
 * @property int $vitD
 * @property int $vitC
 * @property int $om3
 * @property int $om6
 * @property int $vitB1
 * @property int $vitB2
 * @property int $vitB5
 * @property int $vitB6
 * @property int $vitB8
 * @property int $vitB9
 * @property int $vitB12
 * @property int $minMg
 * @property int $minNa
 * @property int $minCa
 * @property int $minCl
 * @property int $minK
 * @property int $minS
 * @property int $minP
 * @property int $minI
 * @property int $minCu
 * @property int $minCr
 */

class Person extends Model
{
    protected $table = 'persons';

     function CalcNorms()
    {
        $this->kcal = self::calcKcalNorm();
        $this->kcal = $this->kcal;
        $this->fat = round(($this->kcal * 0.3) / 4, 2);
        $this->protein = round(($this->kcal * 0.1) / 9, 2);
        $this->carb = round(($this->kcal * 0.6) / 4, 2);
        $this->cellulose = round(0.012 *  $this->kcal, 2);
        $this->water = round($this->weight * 35, 2);
        $this->vitA = 900;
        $this->vitE = 15;
        $this->vitK = 100;
        $this->vitD = 10;
        $this->vitC = 70;
        $this->om3 = round(0.06 * $this->kcal, 2);
        $this->om6 = round(0.015 * $this->kcal, 2);
        $this->vitB1 = 1.3;
        $this->vitB2 = 1.5;
        $this->vitB5 = 4;
        $this->vitB6 = 1.6;
        $this->vitB8 = 1000;
        $this->vitB9 = 400;
        $this->vitB12 = 3;
        $this->minMg = 400;
        $this->minNa = 1300;
        $this->minCa = 2300;
        $this->minCl = 1200;
        $this->minK = 2500;
        $this->minS = 4;
        $this->minP = 1200;
        $this->minCr = 1000;
        $this->minI = 150;
        $this->minCu = 35;
    }

    public function CalcKcalNorm()
    {
        $age = $this->age();
        $calorieNorm = 0;
        $w = (float)$this->weight;
        $h = (float)$this->height;
        $a = (float)$age;
        $act = (float)$this->activity;
        if ($this->gender === "woman") {
            $calorieNorm = ((10 * $w) + (6.25 * $h) - (5 * $a) - 161) * $act;
        } else {
            $calorieNorm = ((10 * $w) + (6.25 * $h) - (5 * $a) + 5) * $act;
        }
        return round($calorieNorm, 2);
    }

    //fields
    public function age()
    {
        $date = new DateTime($this->date_of_birth);
        $now = new DateTime();
        $interval = $now->diff($date);
        return $interval->y;
    }

    public function person_in_menus()
    {
        return PersonInMenu::where([['person_id', $this->id]]);
    }

    static function allByUser($user_id)
    {
        $persons = Data::getData('persons', 'user_id=' . $user_id);
        $res = array();
        foreach ($persons as $person) {
            array_push($res, self::find($person[0]));
        }
        return $res;
    }
}
