<?php

use App\Models\Dish;

require 'C:\Users\Dell\source\SOE_4\public/blocks/pre_head.php';

$menu_id = $_GET['menu'];
$id = $_GET['id'];

Dish::find($id)->delete();



header('Location: ../../public/pages/menu.php?id=' . $menu_id);
