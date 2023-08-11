<?php
require 'C:\Users\Julie\source\SOE_4\public/blocks/pre_head.php';


use App\Models\Shop;

$id = $_GET['id'];

Shop::find($id)->delete();




header('Location: ../../public/pages/shops.php');
