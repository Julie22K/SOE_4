<?php

namespace App;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'C:\Users\Laptopchik\source\soe4\SOE_4\vendor\autoload.php';

if (!isset($_SESSION['user'])) {
    header('Location: /');
    exit();
}

use App\Migrations\Migration;
use App\Models\Dish;

$migration = new Migration();
$migration->run();

?>
<!DOCTYPE html>
<html lang="ua">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="..\assets\images\test_icon.png">
    <?php
    require_once './style.php';
    ?>
    <title>Testing SOE4</title>
</head>

<body>
    <h1>Tests:</h1>
    <?php
    require_once './nav.php';

    $data_for_dish = [
        'date' => '2024-12-11',
        'meal_time_id' => 2,
        'recipe_id' => 2,
        'menu_id' => 2,
        'user_id' => 1,
        'is_private' => true,
    ];

    $dish = new Dish($data_for_dish);

    $dish_created = new Dish($dish->create());

    $dish_finded = Dish::find(14);
    // echo "\nuser_id: " . $dish_finded->user_id;
    // $dish_finded->product =  $dish_finded->user()->login;
    $dish_finded->meal_time = $dish_finded->meal_time()->name;
    $dish_finded->recipe =  $dish_finded->recipe()->name;
    $dish_finded->menu = $dish_finded->menu()->budget;

    $data = [
        "SELECT" => Dish::all(),
        "FIND" => $dish_finded,
        "CREATE" => $dish_created,

    ];

    //UPDATE
    $dish_created->date = '2024-12-10';
    $dish_id_for_update = $dish_created->id;

    $dish_updated = new Dish($dish_created->update($dish_id_for_update));
    $data = array_merge(
        $data,
        ["UPDATE" => $dish_updated]
    );
    //DELETE
    $dish_id_for_delete = $dish_created->id; //todo

    $data = array_merge(
        $data,
        ["DELETE" => $dish->delete($dish_id_for_delete)]
    );

    require_once './printTestData.php';
    printTestData($data);

    require_once './script.php';
    ?>


</body>

</html>