<?php

namespace App\Models;

use App\Data;
use DateTime;
use mysqli;

class Menu
{
    public $id;
    public $table = "menus";
    public $budget;
    public $days_interval;
    public $first_date;
    public $last_date;
    function __construct($budget, $first_date, $last_date, $id = null)
    {
        $this->id = $id;
        $this->budget = $budget;
        $this->first_date = $first_date;
        $this->last_date = $last_date;
        $this->days_interval = $this->days_interval();
    }
    function days_interval()
    {
        $date1 = new DateTime($this->first_date);
        $date2 = new DateTime($this->last_date);
        if ($date1 !== null && $date2 !== null) {
            $interval = $date1->diff($date2);
            $diffDays = $interval->d;
            return $diffDays;
        } else return false;
    }
    public function norms_on_day()
    {
        $res = [];
        foreach ($this->persons() as $person) {
            $info = $person->person_data;
            foreach (Data::$info_data as $val) {
                $res[$val] += $info[$val];
            }
        }
        return $res;
    }
    public function info(array $dishes)
    {
        $res = [];
        foreach ($dishes as $dish) {
            $info = $dish->recipe->info;
            foreach (Data::$info_data as $val) {
                $res[$val] += $info[$val];
            }
        }
        return $res;
    }
    public function statistic_all()
    {
        $info = $this->info($this->dishes());
        $res = [];
        foreach (Data::$info_data as $val) {
            $res[$val] += (100 * $info[$val]) / ($this->norms_on_day()[$val] * $this->days_interval);
        }
        return $res;
    }
    public function statistic_date_avg($date)
    {
        $info = $this->info(Dish::where('date', $date));
        $res = [];
        foreach (Data::$info_data as $val) {
            $res[$val] += (100 * $info[$val]) / $this->norms_on_day()[$val];
        }
        return $res;
    }
    public function statistic_meal_time_avg($id)
    {
        $dishes = [];
        foreach ($this->dishes() as $dish) {
            if ($dish->meal_time_id) array_push($dishes, $dish);
        }
        $info = $this->info($dishes);
        $res = [];
        foreach (Data::$info_data as $val) {
            $res[$val] += (100 * $info[$val]) / ($this->norms_on_day()[$val] / count(MealTime::all()));
        }
        return $res;
    }
    public function budget_need()
    {
        $res = 0;
        foreach ($this->shop_items() as $shop_item) {
            $res += $shop_item->ingredient()->price();
        }
        return $res;
    }
    public function budget_used()
    {
        $res = 0;
        foreach ($this->shop_items() as $shop_item) {
            if ($shop_item->is_exists) $res += $shop_item->ingredient()->price();
        }
        return $res;
    }
    public function budget_need_on_meal_time($id)
    {
        $dishes = [];
        foreach ($this->dishes() as $dish) {
            if ($dish->meal_time_id == $id) array_push($dishes, $dish);
        }
        $res = 0;
        foreach ($dishes as $dish) {
            foreach ($dish->shop_items() as $shop_item) {
                $res += $shop_item->ingredient->price();
            }
        }
        return $res;
    }
    public function budget_need_on_date($date)
    {
        $dishes = [];
        foreach ($this->dishes() as $dish) {
            if ($dish->date == $date) array_push($dishes, $dish);
        }
        $res = 0;
        foreach ($dishes as $dish) {
            foreach ($dish->shop_items() as $shop_item) {
                $res += $shop_item->ingredient->price();
            }
        }
        return $res;
    }
    public function budget_used_on_meal_time($id)
    {
        $dishes = [];
        foreach ($this->dishes() as $dish) {
            if ($dish->meal_time_id == $id) array_push($dishes, $dish);
        }
        $res = 0;
        foreach ($dishes as $dish) {
            foreach ($dish->shop_items() as $shop_item) {
                if ($shop_item->is_exists) $res += $shop_item->ingredient->price();
            }
        }
        return $res;
    }
    public function budget_used_on_date($date)
    {
        $dishes = [];
        foreach ($this->dishes() as $dish) {
            if ($dish->date == $date) array_push($dishes, $dish);
        }
        $res = 0;
        foreach ($dishes as $dish) {
            foreach ($dish->shop_items() as $shop_item) {
                if ($shop_item->is_exists) $res += $shop_item->ingredient->price();
            }
        }
        return $res;
    }
    public function budget_on_meal_time()
    {
        return $this->budget / count(MealTime::all());
    }
    public function budget_on_date()
    {
        return $this->budget / $this->days_interval;
    }
    public function statistic_budget()
    {
        return ['need' => round(($this->budget_need() * 100) / $this->budget), 'used' => round(($this->budget_used() * 100) / $this->budget)];
    }
    public function statistic_budget_on_meal_time($id)
    {
        return ['need' => ($this->budget_need_on_meal_time($id) * 100) / $this->budget, 'used' => ($this->budget_used_on_meal_time($id) * 100) / $this->budget];
    }
    public function statistic_budget_on_date($date)
    {
        return ['need' => ($this->budget_need_on_date($date) * 100) / $this->budget, 'used' => ($this->budget_used_on_date($date) * 100) / $this->budget];
    }
    public function dates()
    {
        $res = array();
        $date = $this->first_date;
        while ($date <= $this->last_date) {
            array_push($res, $date);
            $date = date('Y-m-d', strtotime($date . ' +1 day'));
        }
        return $res;
    }
    public function dishes()
    {
        return Dish::where('menu_id', $this->id);
    }
    public function shop_items()
    {
        $res = [];
        foreach ($this->dishes() as $dish) {
            foreach ($dish->shop_items() as $shop_item) {
                array_push($res, $shop_item);
            }
        }
        return $res;
    }
    public function persons()
    {
        $res = [];
        foreach ($this->person_in_menus() as $person_in_menu) {
            array_push($res, $person_in_menu->person());
        }
        return $res;
    }
    public function person_in_menus()
    {
        return PersonInMenu::where('menu_id', $this->id);
    }
    static function find($id)
    {
        $menu = Data::getItemById('menus', $id);
        return $menu !== FALSE ? new Menu($menu[1], $menu[2], $menu[3], $menu[0]) : false;
    }
    static function where($foreign_key, $id)
    {
        $items = Data::getData("menus", ' ' . $foreign_key . '=' . $id);
        $res = array();
        foreach ($items as $item) {
            array_push($res, Self::find($item[0]));
        }
        return $res;
    }
    static function current()
    {
        $currentDate = date('Y-m-d');
        $res = Data::getData("menus", " '$currentDate' BETWEEN first_date AND COALESCE(last_date, NOW())");
        if ($res !== FALSE && count($res) != 0) {
            return Self::find($res[0][0]);
        } else false;
    }
    static function all()
    {
        $menus = Data::getData('menus');
        $res = array();
        foreach ($menus as $menu) {
            array_push($res, Self::find($menu[0]));
        }
        return $res;
    }
    public function create(array $persons = [])
    {
        Data::createItem('menus', ['budget' => $this->budget, 'first_date' => $this->first_date, 'last_date' => $this->last_date]);
        $menu_id = Data::getLastItemId();
        foreach ($persons as $person) {
            $p = new PersonInMenu($person, $menu_id);
            $p->create();
        }
    }
    static function store($data)
    {
        $menu_id = Data::createItem('menus', ['budget' => $data['budget'], 'first_date' => $data['first_date'], 'last_date' => $data['last_date'],]);
        foreach ($data['persons'] as $person) {
            $p = new PersonInMenu($menu_id, $person);
            $p->create();
        }
    }
    static function update($id,$data)
    {
        Data::deleteItemsWhere('person_in_menus',"menu_id=$id");
        foreach ($data['persons'] as $person) {
            $p = new PersonInMenu($id, $person);
            $p->create();
        }
        return Data::updateItem('menus',$id,['budget' => $data['budget'], 'first_date' => $data['first_date'], 'last_date' => $data['last_date']]);
        
    }
    public function clear()
    {
        foreach ($this->person_in_menus() as $person_in_menu) {
            $person_in_menu->delete();
        }
        foreach ($this->dishes() as $dish) {
            $dish->delete();
        }
    }
    public function delete()
    {
        foreach ($this->person_in_menus() as $person_in_menu) {
            $person_in_menu->delete();
        }
        foreach ($this->dishes() as $dish) {
            $dish->delete();
        }
        Data::deleteItem($this->table, $this->id);
    }
}
