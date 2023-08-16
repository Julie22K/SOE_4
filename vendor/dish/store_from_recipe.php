<?php

use App\Models\Dish;
use App\Models\Menu;

require 'C:\Users\Julie\source\SOE_4\public/blocks/pre_head.php';

//проблема! Потрібно посилатись на конкретне меню, або обирати в модальному вікні меню стрлочками вперед і назад
//$elems={ ["id"]=> string(1) "3" ["monday"]=> array(1) { [0]=> string(9) "breakfast" } ["tuesday"]=> array(1) { [0]=> string(8) "snack(1)" } ["wednesday"]=> array(1) { [0]=> string(5) "lunch" } }
print_r($_POST);
//ще проблема щоб змінювати таблицю

//сформувтаи дати по меню

$menu_id=$_POST['menu'];
$recipe_id=$_POST['id'];

$menu=Menu::find($menu_id);

$days=array();
$current_date=date('Y-n-d', strtotime($menu->first_date));
$last_date=date('Y-n-d', strtotime($menu->last_date));
while(true){
    if($current_date==$last_date) break;
    array_push($days,$current_date);
    $current_date=date('Y-n-d', strtotime($current_date .' +1 day'));
}
var_dump($days);
foreach($days as $day){
    if(!empty($_POST[$day])){
        foreach($_POST[$day] as $key=>$meal_time){
            echo "\ndate:" . $day . "\ttime:" . $key . "\trecipe id:" . $recipe_id . "\tmenu id:" . $menu_id;
            $res=Dish::store([
                "date" => $day,
                "meal_time_id" => $key,
                "menu_id" => $menu_id,
                "recipe_id" => $recipe_id
            ]); 
            echo "res:" . $res;
        }
    }
}


header('Location: ../../public/pages/menu.php?id=' . $menu_id);

