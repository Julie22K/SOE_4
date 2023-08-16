<?php
$menu_id=$_GET['id'];
echo 'export pdf' . Export::pdf($menu_id);





//header('Location: ../../public/pages/menus.php');