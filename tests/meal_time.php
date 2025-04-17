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
use App\Models\MealTime;

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

    $data_for_meal = [
        'name' => 'Snack 3',
        'priority' => 6,
        'is_use' => true,
        'user_id' => 1,
        'is_private' => true,
    ];

    $meal = new MealTime($data_for_meal);

    $meal_created = new MealTime($meal->create());
    $meal_finded =MealTime::find(5);
    $meal_finded->user_login=$meal_finded->user->login;
    $data = [
        "SELECT" => MealTime::all(),
        "FIND" => $meal_finded,
        "CREATE" => $meal_created,

    ];

    //UPDATE
    $meal_created->name = "Test update";
    $meal_id_for_update = $meal_created->id;

    $meal_updated = new MealTime($meal_created->update($meal_id_for_update));
    $data = array_merge(
        $data,
        ["UPDATE" => $meal_updated]
    );
    //DELETE
    $meal_id_for_delete = $meal_created->id; //todo

    $data = array_merge(
        $data,
        ["DELETE" => $meal->delete($meal_id_for_delete)]
    );

    require_once './printTestData.php';
    printTestData($data);

    require_once './script.php';
    ?>


</body>

</html>