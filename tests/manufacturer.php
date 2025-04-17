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
use App\Models\Manufacturer;

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

    $data_for_manufacturer = [
        'name' => 'Test manufacturer',
        'user_id' => 1,
        'is_private' => true,
    ];

    $manufacturer = new Manufacturer($data_for_manufacturer);

    $manufacturer_created = new Manufacturer($manufacturer->create());

    $manufacturer_finded = Manufacturer::find(2);
    // $manufacturer_finded->user = $manufacturer_finded->user()->login;

    $data = [
        "SELECT" => Manufacturer::all(),
        "FIND" => $manufacturer_finded,
        "CREATE" => $manufacturer_created,

    ];

    //UPDATE
    $manufacturer_created->name = "Test update";
    $manufacturer_id_for_update = $manufacturer_created->id;

    $manufacturer_updated = new Manufacturer($manufacturer_created->update($manufacturer_id_for_update));
    $data = array_merge(
        $data,
        ["UPDATE" => $manufacturer_updated]
    );
    //DELETE
    $manufacturer_id_for_delete = $manufacturer_created->id; //todo

    $data = array_merge(
        $data,
        ["DELETE" => $manufacturer->delete($manufacturer_id_for_delete)]
    );

    require_once './printTestData.php';
    printTestData($data);

    require_once './script.php';
    ?>


</body>

</html>