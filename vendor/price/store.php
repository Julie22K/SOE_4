<?php
require_once '../../public/blocks/pre_head.php';

use App\Data;
use App\Models\Manufacturer;
use App\Models\Price;
use App\Models\Shop;
use App\Validate\Validate;

$_POST["is_private"] = isset($_POST["is_private"]) ? ($_POST["is_private"] == "on" ? true : false) : false;

$data = Validate::Validate("price", [
    "product" => $_POST['product_id'],
    "price" => $_POST['price'],
    "weight" => $_POST['weight'],
    "shop" => $_POST['shop_id'],
    "manufacturer" => $_POST['manufacturer_id'],
    "is_private" => $_POST['is_private'],
]);

$_POST['user_id'] = $_SESSION['user']['id'];

if (!is_numeric($data['manufacturer'])) {
    $manufacturer = new Manufacturer([
        'name' => $data['manufacturer'],
        'is_private' => $data['is_private'],
        'user_id' => $_POST['user_id'],
    ]);
    $manufacturer = $manufacturer->create();
    $manufacturers=Manufacturer::WhereAndOrderBy("name = '" . $data['manufacturer'] . "'", "id DESC");
    $_POST['manufacturer_id'] =$manufacturers[0]->id;
}

if (!is_numeric($data['shop'])) {
    $shop = new Shop([
        'name' => $data['shop'],
        'is_private' => $data['is_private'],
        'user_id' => $_POST['user_id'],
    ]);
    $shop = $shop->create();
    $shops=Shop::WhereAndOrderBy("name = '" . $data['shop'] . "'", "id DESC");
    $_POST['shop_id'] =$shops[0]->id;
}

$new_price = new Price($_POST);
$res = $new_price->create();

if (is_array($res)) {
    unset($_SESSION['validation_data']);
    returnToPrevPage();
}
