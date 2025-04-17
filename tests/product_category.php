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
use App\Models\ProductCategory;

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

    $data_for_product_category = [
        'name' => 'Test category',
        'image_name' => 'test url',
        'user_id' => 1,
    ];

    $product_category = new ProductCategory($data_for_product_category);

    $product_category_created = new ProductCategory($product_category->create());
    $product_category_finded =ProductCategory::find(5);
    $product_category_finded->user_login=$product_category_finded->user!=null?$product_category_finded->user->login:' - ';
    
    $data = [
        "SELECT" => ProductCategory::all(),
        "FIND" => $product_category_finded,
        "CREATE" => $product_category_created,

    ];

    //UPDATE
    $product_category_created->name = "Test update";
    $product_category_id_for_update = $product_category_created->id;

    $product_category_updated = new ProductCategory($product_category_created->update($product_category_id_for_update));
    $data = array_merge(
        $data,
        ["UPDATE" => $product_category_updated]
    );
    //DELETE
    $product_category_id_for_delete = $product_category_created->id; //todo

    $data = array_merge(
        $data,
        ["DELETE" => $product_category->delete($product_category_id_for_delete)]
    );

    require_once './printTestData.php';
    printTestData($data);

    require_once './script.php';
    ?>


</body>

</html>