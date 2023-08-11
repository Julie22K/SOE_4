<?php

use App\Models\Dish;

require 'C:\Users\Julie\source\SOE_4\public/blocks/pre_head.php';

$date = $_POST['date'];
$meal_time_id = $_POST['meal_time_id'];
$menu = $_POST['menu'];
$recipes = $_POST['recipes'];
if (is_array($recipes)) {
    foreach ($recipes as $recipe) {
        $res = Dish::store([
            "date" => $date,
            "meal_time_id" => $meal_time_id,
            "menu_id" => $menu,
            "recipe_id" => $recipe
        ]);
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
