<?php

use App\Models\Menu;

require 'C:\Users\Dell\source\SOE_4\public/blocks/pre_head.php';

$id = $_GET['id'];
//todo
$menu = Menu::find($id);

$menu->clear($id);


header('Location: ../../public/pages/menu.php?id=' . $id);
