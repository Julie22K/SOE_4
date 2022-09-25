<?php
require_once '../config/connect.php';

mysqli_query($soe, "DELETE FROM `shoplist`");
mysqli_query($soe, "DELETE FROM `dishes`");

header('Location: ../menu.php');
