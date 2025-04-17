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

$migration = new Migration();
$migration->run();

use App\Models\Product;
use App\Models\Recipe;

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

    $data_for_item = [
        'title' => 'Apple',
        'recipe_category_id' => 2,
        'video_url' => 'smsmsmsm',
        'image_url' => 'smsmsmsm',
        'description' => 'smsmsmsm',
        'portions' => 'smsmsmsm',
        'user_id' => 2,
        'is_private' => false,
    ];

    $item = new Recipe($data_for_item);

    $item_created = new Recipe($item->create());
    $recipe_finded= Recipe::find(1);
    $recipe_finded->category=$recipe_finded->category()->name;
    
    $data = [
        "SELECT" => Recipe::all(),
        "FIND" => $recipe_finded,
        "CREATE" => $item_created,
    ];

    //UPDATE
    $item_created->title = "Green salad";
    $item_id_for_update = $item_created->id;

    $item_updated = new Recipe($item_created->update($item_id_for_update));
    $data = array_merge(
        $data,
        ["UPDATE" => $item_updated]
    );
    //DELETE
    $item_id_for_delete = $item_created->id; //todo

    $data = array_merge(
        $data,
        ["DELETE" => $item->delete($item_id_for_delete)]
    );

    require_once './printTestData.php';
    printTestData($data);

    require_once './script.php';
    ?>


</body>

</html>