<?php

use App\Data;
use App\Models\Menu;

require 'C:\Users\Dell\source\SOE_4\public/blocks/pre_head.php';

$budget = $_POST['budget'];
$persons = $_POST['persons'];
$first_date = $_POST['first_date'];
$last_date = $_POST['last_date'];

Menu::store([
    'budget' => $budget,
    'persons' => $persons,
    'first_date' => $first_date,
    'last_date' => $last_date
]);

header('Location: ../../public/pages/menus.php');

//header('Location: ../../public/pages/menu.php?id' . $id);
