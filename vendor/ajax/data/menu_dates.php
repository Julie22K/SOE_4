<?php
require 'C:\Users\Julie\source\SOE_4\public/blocks/pre_head.php';

use App\Models\Menu;

$menu=Menu::find($_GET['id']);
//get_menu_dates

echo $menu->first_date . '_' . $menu->last_date;