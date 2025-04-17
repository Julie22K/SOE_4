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

use App\Models\PersonInMenu;
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

    $data_for_person_in_menu = [
        'menu_id' => 2,
        'person_id' => 1,
    ];

    $person_in_menu = new PersonInMenu($data_for_person_in_menu);

    $person_in_menu_created = new PersonInMenu($person_in_menu->create());
    
    $person_in_menu_finded= PersonInMenu::find(2);

    $person_in_menu_finded->menu=$person_in_menu_finded->menu()->budget;
    $person_in_menu_finded->person=$person_in_menu_finded->person()->name;
    
    $data = [
        "SELECT" => PersonInMenu::all(),
        "FIND" => $person_in_menu_finded,
        "CREATE" => $person_in_menu_created,

    ];

    //UPDATE
    $person_in_menu_created->person_id = 2;
    $person_in_menu_id_for_update = $person_in_menu_created->id;

    $person_in_menu_updated = new PersonInMenu($person_in_menu_created->update($person_in_menu_id_for_update));
    $data = array_merge(
        $data,
        ["UPDATE" => $person_in_menu_updated]
    );
    //DELETE
    $person_in_menu_id_for_delete = $person_in_menu_created->id; //todo

    $data = array_merge(
        $data,
        ["DELETE" => $person_in_menu->delete($person_in_menu_id_for_delete)]
    );

    require_once './printTestData.php';
    printTestData($data);

    require_once './script.php';
    ?>


</body>

</html>