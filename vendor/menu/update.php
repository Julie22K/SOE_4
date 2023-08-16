<?php

use App\Data;
use App\Models\Menu;

require 'C:\Users\Julie\source\SOE_4\public/blocks/pre_head.php';
$id=$_GET['id'];

$data=[
    'budget'=> $_POST['budget'],
    'persons'=> $_POST['persons'],
    'first_date'=> $_POST['first_date'],
    'last_date'=> $_POST['last_date'],
];

Menu::update($id,$data);

header('Location: ../../public/pages/menus.php');
