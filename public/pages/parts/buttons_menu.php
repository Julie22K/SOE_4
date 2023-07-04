<?php

use App\Models\Menu;

$back_menu_exists = true;
$next_menu_exists = true;

$back_menu = Menu::find($menu_id - 1);
$next_menu = Menu::find($menu_id + 1);
if ($back_menu == false) $back_menu_exists = false;
if ($next_menu == false) $next_menu_exists = false;
//var_dump($prev_id, $next_id, $menu_id);
?>
<button class="btn btn-cancel m-2" style="width: 25%;" onclick="location.href='menus.php'">Всі меню</button>
<button class="btn m-2" style="width: 25%;" onclick="location.href='menu.php?id=<?= ($menu->id) - 1 ?>'" <?= $back_menu_exists ? '' : 'disabled' ?>>Попередній тиждень</button>
<button class="btn m-2" style="width: 25%;" onclick="location.href='menu.php?id=<?= ($menu->id) + 1 ?>'" <?= $next_menu_exists ? '' : 'disabled' ?>>Наступний тиждень</button>