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

use App\Models\Person;
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

    $data_for_person = [
        'name' => 'Julie',
        'gender' => 'woman',
        'date_of_birth' => '2003-02-22',
        'weight' => 45,
        'height' => 156,
        'activity' => '1.3',
    ];

    $person = new Person($data_for_person);
    $person->CalcNorms(); //important for person

    $person_created = new Person($person->create());
    $data = [
        "SELECT" => Person::all(),
        "FIND" => Person::find(5),
        "CREATE" => $person_created,

    ];

    //UPDATE
    $person_created->weight = 57;
    $person_created->CalcNorms();
    $person_id_for_update = $person_created->id;

    $person_updated = new Person($person_created->update($person_id_for_update));
    $data = array_merge(
        $data,
        ["UPDATE" => $person_updated]
    );
    //DELETE
    $person_id_for_delete = $person_created->id; //todo

    $data = array_merge(
        $data,
        ["DELETE" => $person->delete($person_id_for_delete)]
    );

    require_once './printTestData.php';
    printTestData($data);

    require_once './script.php';
    ?>


</body>

</html>