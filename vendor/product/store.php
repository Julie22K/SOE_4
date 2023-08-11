<?php

use App\Data;
use App\Models\Product;

require 'C:\Users\Julie\source\SOE_4\public/blocks/pre_head.php';

$title = $_POST['title'];
$category = $_POST['category'];
$image_url = $_POST['image_url'];
$data = [];
foreach (Data::$info_data as $item) {
    $data[$item] = (float)$_POST[$item];
}
var_dump($_POST);
$prices = $_POST['prices'];
$shops = $_POST['shops'];
$manufacturers = $_POST['manufacturers'];
$weights = $_POST['weights'];

$new_product = new Product($title, $category, $image_url, $data);
$res = $new_product->create($prices, $weights, $manufacturers, $shops);
var_dump($res);




header('Location: ../../public/pages/products.php');

//if ($res) header('Location: ../../public/pages/products.php');
//else var_dump($res);
