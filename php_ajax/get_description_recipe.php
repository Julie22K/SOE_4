<?php

require_once '../config/connect.php';

$post_id = $_GET['id'];


$recipes = mysqli_query($soe,"SELECT * FROM `recipes` WHERE ID='$post_id'");
$recipes = mysqli_fetch_all($recipes);

$recipe=$recipes[0];

echo $recipe[5]!=""?$recipe[5]:'Recipe doesn`t have description';