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
use App\Models\RecipeCategory;

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

    $data_for_recipe_category = [
        'name' => 'Test category',
        'image_name' => 'test url',
        'user_id' => 1,
    ];

    $recipe_category = new RecipeCategory($data_for_recipe_category);

    $recipe_category_created = new RecipeCategory($recipe_category->create());
    $recipe_category_finded =RecipeCategory::find(5);
    $recipe_category_finded->user_login=$recipe_category_finded->user!=null?$recipe_category_finded->user->login:' - ';
    
    $data = [
        "SELECT" => RecipeCategory::all(),
        "FIND" => $recipe_category_finded,
        "CREATE" => $recipe_category_created,

    ];

    //UPDATE
    $recipe_category_created->name = "Test update";
    $recipe_category_id_for_update = $recipe_category_created->id;

    $recipe_category_updated = new RecipeCategory($recipe_category_created->update($recipe_category_id_for_update));
    $data = array_merge(
        $data,
        ["UPDATE" => $recipe_category_updated]
    );
    //DELETE
    $recipe_category_id_for_delete = $recipe_category_created->id; //todo

    $data = array_merge(
        $data,
        ["DELETE" => $recipe_category->delete($recipe_category_id_for_delete)]
    );

    require_once './printTestData.php';
    printTestData($data);

    require_once './script.php';
    ?>


</body>

</html>