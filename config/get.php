<!-- function GetAByB($D)
{

  
    return $D;
} -->
<?php
require_once 'connect.php';
function GetProductDataByID($ID)
{
}

function GetDishDataByID($ID, $database)
{
    $dishes = mysqli_query($database, "SELECT * FROM `dishes` WHERE `ID`='$ID'");
    $dishes = mysqli_fetch_all($dishes);
    return $dishes[0];
}
