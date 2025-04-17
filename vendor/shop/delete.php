<?php
require_once '../../public/blocks/pre_head.php';

use App\Models\Shop;

try {
    $id = $_GET['id'];
    $res_message = Shop::find($id)->delete($id);
    $_SESSION['messages']['success'] = $res_message;
    returnToReallyPrevPage();
} catch (\Throwable $th) {
    $_SESSION['messages']['danger'] = "Помилка видалення магазину";
    returnToReallyPrevPage();
}
