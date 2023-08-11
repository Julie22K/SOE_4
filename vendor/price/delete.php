<?php

use App\Models\Shop;

require 'C:\Users\Julie\source\SOE_4\public/blocks/pre_head.php';

$id = $_GET['id'];

Shop::find($id)->delete();


header('Location: ../../public/pages/prices.php');
