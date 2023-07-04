<?php

use App\Models\Manufacturer;

require 'C:\Users\Dell\source\SOE_4\public/blocks/pre_head.php';

$name = $_POST['name'];

Manufacturer::store([
    'name' => $name,
]);


header('Location: ../../public/pages/manufacturers.php');
