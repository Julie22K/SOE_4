<?php
require_once '../../public/blocks/pre_head.php';

use App\Models\Price;
use App\Models\Product;
use App\Validate\Validate;


$res = loadImage($_FILES["image_url"]);

$image_url = "/load_data/images/products/" . $_FILES["image_url"]['name'];

$_POST['image_url']=$image_url;

$_POST["is_private"] = isset($_POST["is_private"]) ? ($_POST["is_private"] == "on" ? true : false) : false;


$v_res=Validate::Validate(
    "product",
    [
        "title" => $_POST['title'],
        "product_category_id" => $_POST['category'],
        "is_private" => isset($_POST['is_private'])?$_POST['is_private']:false,
        "image_url" => $_POST['image_url'],
        "kcal" => $_POST['kcal'],
    ]
);

$prices = $_POST['prices'];
$shops = $_POST['shops'];
$manufacturers = $_POST['manufacturers'];
$weights = $_POST['weights'];

$_POST['product_category_id'] = $_POST['category'];
unset($_POST["category"]);

$_POST["is_private"] = $_POST["is_private"] == "on" ? true : false;

$_POST['user_id'] = $_SESSION['user']['id'];

unset($_POST["prices"]);
unset($_POST["shops"]);
unset($_POST["manufacturers"]);
unset($_POST["weights"]);

$product = new Product($_POST);

$product = $product->create();

for ($i = 0; $i < count($prices); $i++) {
    $data_for_validating = [
        "price" => $prices[$i],
        "shop" => $shops[$i],
        "manufacturer" => $manufacturers[$i],
        "weight" => $weights[$i],
        "product" => $product["id"],
        "is_private" => $_POST["is_private"],
    ];
    $data_for_creating = Validate::Validate("price", $data_for_validating);
    $data_for_creating['user_id']=$_SESSION['user']['id'];
    $data_for_creating['is_private']=false;

    // $price = new Price($data_for_creating);
    // $price=$price->create();
}

    // returnToPrevPage();
?>