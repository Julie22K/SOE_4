<?php

use App\Models\Export;
require_once 'C:\Users\Julie\source\SOE_4\public/blocks/pre_head.php';
try{
    $menu_id=$_GET['id'];
    echo 'export excel ' . Export::just();
}
catch(Exception $error)
{
    echo $error;
}



//header('Location: ../../public/pages/menus.php');
