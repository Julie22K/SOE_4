<?php

namespace App\Models;

use App\Data;
/**
 * @property int $menu_id
 * @property int $meal_time_id
 * @property int $date
 * @property int $recipe_id
 */
class Dish extends Model
{
    protected $table = 'dishes';
    
    public function menu()
    {
        return Menu::find($this->menu_id);
    }
    public function shop_items()
    {
        return ShopItem::where([['dish_id', $this->id]]);
    }
    public function meal_time()
    {
        return MealTime::find($this->meal_time_id);
    }
    public function recipe()
    {
        return Recipe::find($this->recipe_id);
    }
    
    static function store_dishes($menu, $date, $meal_time, array $recipes)
    {
        foreach ($recipes as $recipe) {
            $dish = new Dish($date, $meal_time, $menu, $recipe);
            $dish->create();
        }
    }
    
    public function user()
    {
        echo "\nuser_id: " . $this->user_id;
        $res=User::find($this->user_id);
        print_r($res);
        return $res;
    }
}
