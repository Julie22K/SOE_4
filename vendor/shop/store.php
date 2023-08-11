<?php
require 'C:\Users\Julie\source\SOE_4\public/blocks/pre_head.php';

use App\Models\Shop;

$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];

Shop::store([
    'name' => $name,
    'address' => $address,
    'phone' => $phone
]);


header('Location: ../../public/pages/shops.php');
