<?php
require 'C:\Users\Julie\source\SOE_4\public/blocks/pre_head.php';


use App\Models\Menu;

$menus=Menu::all();

$res="";

foreach($menus as $menu){
    $res=$res . '<option value="' . $menu->id . '">' . $menu->first_date . ' - ' . $menu->last_date . '</option>';
}
echo $res;