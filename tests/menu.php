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
use App\Models\Menu;

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

    $data_for_menu = [
        'budget' => 1300,
        'first_date' => '2024-12-09',
        'last_date' => '2024-12-15',
        'user_id' => 1,
        'is_private' => true,
    ];

    $menu = new Menu($data_for_menu);

    $menu_created = new Menu($menu->create());
    $menu_finded =Menu::find(1);
    $menu_finded->user_login=$menu_finded->user!=null?$menu_finded->user->login:"";
    
    $data = [
        "SELECT" => Menu::all(),
        "FIND" => $menu_finded,
        "CREATE" => $menu_created,

    ];

    //UPDATE
    $menu_created->budget = 1200;
    $menu_id_for_update = $menu_created->id;

    $menu_updated = new Menu($menu_created->update($menu_id_for_update));
    $data = array_merge(
        $data,
        ["UPDATE" => $menu_updated]
    );
    //DELETE
    $menu_id_for_delete = $menu_created->id; //todo

    $data = array_merge(
        $data,
        ["DELETE" => $menu->delete($menu_id_for_delete)]
    );

    require_once './printTestData.php';
    printTestData($data);

    require_once './script.php';
    ?>


</body>

</html>