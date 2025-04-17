<?php
require_once '../../public/blocks/pre_head.php';

use App\Models\Manufacturer;

try {
    $id = $_GET['id'];
    $res_message = Manufacturer::find($id)->delete($id);
    $_SESSION['messages']['success'] = $res_message;
    returnToReallyPrevPage();
} catch (\Throwable $th) {
    $_SESSION['messages']['danger'] = "Помилка видалення виробника";
    returnToReallyPrevPage();
}
