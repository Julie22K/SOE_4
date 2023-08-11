<?php
require 'C:\Users\Julie\source\SOE_4\public/blocks/pre_head.php';


use App\Models\Shop;
use App\Models\ShopItem;

$menu_id = $_GET['id'];
$shop_items = $_POST['shop_items'];
$shop_items_checked = $_POST['shop_items_checked'];
var_dump($_POST);


foreach ($shop_items as $shop_item) {

    $item = ShopItem::find($shop_item);
    if (in_array($shop_item, $shop_items_checked)) $res = $item->check();
    else $res = $item->uncheck();
    //var_dump($res);
}




header('Location: ../../public/pages/shopping_list.php?id=' . $menu_id);
