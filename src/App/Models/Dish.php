<?php

namespace App\Models;

use App\Data;

class Dish
{
    public $id;
    public $table = "dishes";
    public $date;
    public $meal_time_id;
    public $menu_id;
    public $recipe_id;
    function __construct($date, $meal_time_id, $menu_id, $recipe_id, $id = null)
    {
        $this->id = $id;
        $this->date = $date;
        $this->meal_time_id = $meal_time_id;
        $this->menu_id = $menu_id;
        $this->recipe_id = $recipe_id;
    }
    public function menu()
    {
        return Menu::find($this->menu_id);
    }
    public function shop_items()
    {
        return ShopItem::where('dish_id', $this->id);
    }
    public function meal_time()
    {
        return MealTime::find($this->meal_time_id);
    }
    public function recipe()
    {
        return Recipe::find($this->recipe_id);
    }
    static function find($id)
    {
        $dish = Data::getItemById('dishes', $id);
        return new Dish($dish[1], $dish[2], $dish[4], $dish[3], $dish[0]);
    }
    static function where($foreign_key, $id)
    {
        $items = Data::getData("dishes", ' ' . $foreign_key . '=' . $id);
        $res = array();
        foreach ($items as $item) {
            array_push($res, Self::find($item[0]));
        }
        return $res;
    }
    static function all()
    {
        $dishes = Data::getData('dishes');
        $res = array();
        foreach ($dishes as $dish) {
            array_push($res, Self::find($dish[0]));
        }
        return $res;
    }
    public function create()
    {
        $dish_id = Data::createItem('dishes', ['date' => $this->date, 'meal_time_id' => $this->meal_time_id, 'menu_id' => $this->menu_id, 'recipe_id' => $this->recipe_id]);
        $recipe = $this->recipe();
        $ingredients = $recipe->ingredients();
        foreach ($ingredients as $ingredient) {
            $shop_item = new ShopItem($ingredient->id, $ingredient->product()->id, $dish_id, 0, false);
            $shop_item->create();
        }
        return $dish_id != 0 ? true : ['date' => $this->date, 'meal_time_id' => $this->meal_time_id, 'menu_id' => $this->menu_id, 'recipe_id' => $this->recipe_id];
    }
    static function store($data)
    {
        $dish_id = Data::createItem('dishes', $data);
        $dish = Dish::find($dish_id);
        $recipe = $dish->recipe();
        $ingredients = $recipe->ingredients();
        foreach ($ingredients as $ingredient) {
            $shop_item = new ShopItem($ingredient->id, $ingredient->product()->id, $dish_id, 0, false);
            $shop_item->create();
        }
        return $dish_id != 0 ? true : $data;
    }
    static function store_dishes($menu, $date, $meal_time, array $recipes)
    {
        foreach ($recipes as $recipe) {
            $dish = new Dish($date, $meal_time, $menu, $recipe);
            $dish->create();
        }
    }
    public function delete()
    {
        foreach ($this->shop_items() as $shop_item) {
            $shop_item->delete();
        }
        Data::deleteItem($this->table, $this->id);
    }
}
