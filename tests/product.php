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
use App\Models\ProductCategory;
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
        'product_category_id' => 2,
        'image_url' => 'smsmsmsm',
        'user_id' => 2,
        'is_private' => false,
        'kcal' => '133',
    ];

    $item = new Product($data_for_item);

    $item_created = new Product($item->create());

    $product_finded= Product::find(2);
    $product_finded->category=$product_finded->category()->name;
    $product_finded->avg_price=$product_finded->avg_price();
    $data = [
        "SELECT" => Product::all(),
        "FIND" =>$product_finded,
        "CREATE" => $item_created,

    ];

    //UPDATE
    $item_created->title = "Green apple";
    $item_id_for_update = $item_created->id;

    $item_updated = new Product($item_created->update($item_id_for_update));
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