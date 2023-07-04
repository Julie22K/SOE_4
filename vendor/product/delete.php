<?php

use App\Models\Product;

require 'C:\Users\Dell\source\SOE_4\public/blocks/pre_head.php';

$id = $_GET['id'];

Product::find($id)->delete();



header('Location: ../../public/pages/products.php');
