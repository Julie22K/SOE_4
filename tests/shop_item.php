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

use App\Models\ShopItem;
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


    //tests
    echo '<h1>Tests:</h1>';

    //TODO:
    $data_for_shop_item = [
        'ingredient_id' => 2,
        'product_id' => 3,
        'dish_id' => 2,
        'is_exists' => false,
        'price' => 15.64,
    ];

    $shop_item = new ShopItem($data_for_shop_item);

    $shop_item_created = new ShopItem($shop_item->create());
    
    $shop_item_finded= ShopItem::find(1);
    $shop_item_finded->ingredient=$shop_item_finded->ingredient()->weight;
    $shop_item_finded->product=$shop_item_finded->product()->title;
    $shop_item_finded->dish=$shop_item_finded->dish()->recipe()->name;
    
    $data = [
        "SELECT" => ShopItem::all(),
        "FIND" => $shop_item_finded,
        "CREATE" => $shop_item_created,

    ];

    //UPDATE
    $shop_item_created->price = 12.50;
    $shop_item_id_for_update = $shop_item_created->id;

    $shop_item_updated = new ShopItem($shop_item_created->update($shop_item_id_for_update));
    $data = array_merge(
        $data,
        ["UPDATE" => $shop_item_updated]
    );
    //DELETE
    $shop_item_id_for_delete = $shop_item_created->id; //todo

    $data = array_merge(
        $data,
        ["DELETE" => $shop_item->delete($shop_item_id_for_delete)]
    );

    require_once './printTestData.php';
    printTestData($data);

    require_once './script.php';
    ?>


</body>

</html>