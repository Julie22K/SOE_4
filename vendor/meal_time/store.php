<?php
require 'C:\Users\Julie\source\SOE_4\public/blocks/pre_head.php';

use App\Models\MealTime;

var_dump($_POST);
if (count($_POST) != 0) {
    $names = $_POST['names'];
    $priorities = $_POST['priorities'];
    $ids = $_POST['ids'];

    $old_data = MealTime::all();

    //add item
    foreach ($ids as $key => $id) {

        $is_contains = false;
        foreach ($old_data as $item) {
            if ($item->id == $id) {
                $is_contains = true;
                break;
            }
        }
        if (!$is_contains) {
            echo "create item $names[$key] $priorities[$key]";
            MealTime::store([
                "name" => $names[$key],
                "priority" => $priorities[$key]
            ]);
        }
    }
    foreach ($old_data as $item) {

        $is_contains = false;
        $k = 0;
        foreach ($ids as $key => $id) {
            if ($item->id == $id) {
                $is_contains = true;
                $k = $key;
                break;
            }
        }
        if (!$is_contains) {
            echo "update item`s is_use" .  $item->name . " " . $item->id;
            MealTime::update($item->id, [
                "is_use" => false
            ]);
        } else {
            if ($item->priority != $priorities[$k]) {
                echo "update item`s priority $names[$k] $priorities[$k]";
                MealTime::update($item->id, [
                    "priority" => $priorities[$k]
                ]);
            }
        }
    }
}

header('Location: ../../public/pages/meal_times.php');
