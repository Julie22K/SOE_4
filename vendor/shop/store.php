<?php

require_once '../../public/blocks/pre_head.php';

use App\Models\Shop;
use App\Validate\Validate;

$_POST['is_private'] = isset($_POST['is_private']) ?$_POST['is_private'] : false;


$data = Validate::Validate("shop", $_POST);

$data['user_id'] = $_SESSION['user']['id'];

$new_shop = new Shop($data);

$res = $new_shop->create();

if (is_array($res)) {
    unset($_SESSION['validation_data']);
    returnToPrevPage();
}
