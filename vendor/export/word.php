<?php
$menu_id=$_GET['id'];
echo 'export word' . Export::word($menu_id);



//header('Location: ../../public/pages/menus.php');