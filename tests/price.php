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
use App\Models\Price;

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

    $data_for_price = [
        'weight' => 100,
        'price' => 23.4,
        'product_id' => 1,
        'manufacturer_id' => 1,
        'shop_id' => 1,
        'user_id' => 3,
        'is_private' => true,
    ];

    $price = new Price($data_for_price);

    $price_created = new Price($price->create());
    $price_finded = Price::find(5);
    $price_finded->recipe_name = $price_finded->manufacturer != null ? $price_finded->manufacturer->name : " - ";
    $price_finded->product_title = $price_finded->product != null ? $price_finded->product->title : " - ";
    $price_finded->recipe_name = $price_finded->shop != null ? $price_finded->shop->name : " - ";
    $price_finded->user_login = $price_finded->user != null ? $price_finded->user->login : " - ";

    $data = [
        "SELECT" => Price::all(),
        "FIND" => $price_finded,
        "CREATE" => $price_created,

    ];

    //UPDATE
    $price_created->price = 12.50;
    $price_id_for_update = $price_created->id;

    $price_updated = new Price($price_created->update($price_id_for_update));
    $data = array_merge(
        $data,
        ["UPDATE" => $price_updated]
    );
    //DELETE
    $price_id_for_delete = $price_created->id; //todo

    $data = array_merge(
        $data,
        ["DELETE" => $price->delete($price_id_for_delete)]
    );

    require_once './printTestData.php';
    printTestData($data);

    require_once './script.php';
    ?>


</body>

</html>