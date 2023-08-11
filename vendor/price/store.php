<?php

use App\Models\Price;

require 'C:\Users\Julie\source\SOE_4\public/blocks/pre_head.php';

$product = $_POST['product'];
$price = $_POST['price'];
$weight = $_POST['weight'];
$manufacturer = $_POST['manufacturer'];
$shop = $_POST['shop'];

Price::store([
    'product_id' => $product,
    'price' => $price,
    'weight' => $weight,
    'manufacturer_id' => $manufacturer,
    'shop_id' => $shop
]);


header('Location: ../../public/pages/products.php');
