<?php

use App\Models\Dish;
use App\Models\Recipe;

require 'C:\Users\Julie\source\SOE_4\public/blocks/pre_head.php';

$date = $_POST['date'];
$meal_time_id = $_POST['meal_time_id'];
$menu = $_POST['menu'];
$recipes = $_POST['recipes'];
var_dump($_POST);
if (is_array($recipes)) {
    foreach ($recipes as $recipe) {
        var_dump($recipe);
        if(is_numeric($recipe)){
            echo "is_numberic";
            $res = Dish::store([
                "date" => $date,
                "meal_time_id" => $meal_time_id,
                "menu_id" => $menu,
                "recipe_id" => $recipe
            ]);
        }else{
            $new_recipe=Recipe::store_by_title($recipe);
            $res = Dish::store([
                "date" => $date,
                "meal_time_id" => $meal_time_id,
                "menu_id" => $menu,
                "recipe_id" => $new_recipe
            ]);
            echo $new_recipe;
        }
    }
} else {
    $res = Dish::store([
        "date" => $date,
        "meal_time_id" => $meal_time_id,
        "menu_id" => $menu,
        "recipe_id" => $recipes[0]
    ]);
}


header('Location: ../../public/pages/menu.php?id=' . $menu);
