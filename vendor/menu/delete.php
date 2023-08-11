<?php

use App\Models\Menu;

require 'C:\Users\Julie\source\SOE_4\public/blocks/pre_head.php';


$id = $_GET['id'];

Menu::find($id)->delete();



header('Location: ../../public/pages/menus.php');
