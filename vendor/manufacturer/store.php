<?php

require_once '../../public/blocks/pre_head.php';

use App\Validate\Validate;
use App\Models\Manufacturer;

$_POST['is_private'] = isset($_POST['is_private']) ? $_POST['is_private'] : false;

$data = Validate::Validate("manufacturer", $_POST);

$data['user_id'] = $_SESSION['user']['id'];

$new_shop = new Manufacturer($data);

$res = $new_shop->create();

if (is_array($res)) {
    unset($_SESSION['validation_data']);
    returnToPrevPage();
}
