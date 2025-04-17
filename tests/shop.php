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
use App\Models\Shop;

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

    $data_for_shop = [
        'name' => 'Test shop',
        'phone' => '11-22-33',
        'address' => 'test address',
        'user_id' => 1,
        'is_private' => true,
    ];

    $shop = new Shop($data_for_shop);

    $shop_created = new Shop($shop->create());

    $shop_finded =Shop::find(2);
    $shop_finded->user_=$shop_finded->user!=null?$shop_finded->user->login:" - ";
   
    $data = [
        "SELECT" => Shop::all(),
        "FIND" => $shop_finded,
        "CREATE" => $shop_created,

    ];

    //UPDATE
    $shop_created->phone = '11-22-34';
    $shop_id_for_update = $shop_created->id;

    $shop_updated = new Shop($shop_created->update($shop_id_for_update));
    $data = array_merge(
        $data,
        ["UPDATE" => $shop_updated]
    );
    //DELETE
    $shop_id_for_delete = $shop_created->id; //todo

    $data = array_merge(
        $data,
        ["DELETE" => $shop->delete($shop_id_for_delete)]
    );

    require_once './printTestData.php';
    printTestData($data);

    require_once './script.php';
    ?>


</body>

</html>