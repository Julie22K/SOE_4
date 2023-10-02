<?php
require 'C:\Users\Julie\source\SOE_4\public/blocks/pre_head.php';

use App\Models\Shop;
use App\Validate;


$data=Validate::Validate('shop',[
    "name"=>$_POST['name'],
    "address"=>$_POST['address'],
    "phone"=>$_POST['phone'],
]);

$new_shop= new Shop($data['name'],$data['address'],$data['phone']);
$new_shop->create();

header('Location: ../../public/pages/shops.php');
