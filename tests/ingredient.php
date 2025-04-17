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
use App\Models\Ingredient;

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

    $data_for_ingredient = [
        'weight' => 200,
        'recipe_id' => 20,
        'product_id' => 2,
    ];

    $ingredient = new Ingredient($data_for_ingredient);

    $ingredient_created = new Ingredient($ingredient->create());
    $ingredient_finded =Ingredient::find(5);
    $ingredient_finded->recipe=$ingredient_finded->recipe()->name;
    $ingredient_finded->product=$ingredient_finded->product()->title;
    $data = [
        "SELECT" => Ingredient::all(),
        "FIND" => $ingredient_finded,
        "CREATE" => $ingredient_created,

    ];

    //UPDATE
    $ingredient_created->weight = 150;
    $ingredient_id_for_update = $ingredient_created->id;

    $ingredient_updated = new Ingredient($ingredient_created->update($ingredient_id_for_update));
    $data = array_merge(
        $data,
        ["UPDATE" => $ingredient_updated]
    );
    //DELETE
    $ingredient_id_for_delete = $ingredient_created->id; //todo

    $data = array_merge(
        $data,
        ["DELETE" => $ingredient->delete($ingredient_id_for_delete)]
    );

    require_once './printTestData.php';
    printTestData($data);

    require_once './script.php';
    ?>


</body>

</html>