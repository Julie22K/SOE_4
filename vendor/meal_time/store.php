<?php

require_once '../../public/blocks/pre_head.php';

use App\Models\MealTime;

$ids = $_POST['ids'];
$names = $_POST['names'];
$priorities = $_POST['priorities'];
if (count($_POST) != 0) {
    $form_meal_times = [];
    for ($i = 0; $i < count($names); $i++) {

        $id = $ids[$i];
        $name = $names[$i];
        $priority = $priorities[$i];
        $is_use = isset($_POST['is_uses_'.$id])?true:false;

        if ($id == "null") {
            $data_for_meal_time = [
                'name' => $name,
                'priority' => $priority,
                'is_use' => $is_use,
                'user_id' =>  $_SESSION['user']['id'],
                'is_private' => true,
            ];

            $meal_time = new MealTime($data_for_meal_time);

            $meal_time_created = new MealTime($meal_time->create());
        } else {
            $meal_time_finded = MealTime::find($ids[$i]);
            $meal_time_finded->name = $name;
            $meal_time_finded->priority = $priority;
            $meal_time_finded->is_use = $is_use == "on" ? 1 : 0;
            $meal_time_finded->update($id);
        }
    }
}
returnToReallyPrevPage();
?>