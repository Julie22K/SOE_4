<?php
require_once '../config/connect.php';

require_once '../config/nutr.php';

$name = $_POST['name'];
$type = $_POST['type'];
$weight = $_POST['weight'];


$products = mysqli_query($soe, "SELECT * FROM `products` WHERE `Name`='$name'");
$product = mysqli_fetch_assoc($products);
$productid = $product['ID'];


mysqli_query($soe, "INSERT INTO `shoplist`(`Name`,`Type`, `Weight`, `Price`,  `ProductID`) 
    VALUES ('$name','$type','$weight','$price','$productid')");

header('Location: ../shoplist.php');
