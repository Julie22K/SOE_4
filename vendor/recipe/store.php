<?php
require 'C:\Users\Dell\source\SOE_4\public/blocks/pre_head.php';
//echo $_POST;

use App\Models\Recipe;

$title = $_POST['title'];
$category = $_POST['recipe_category'];
$image_url = $_POST['image_url'];
$video_url = $_POST['video_url'];
$description = $_POST['description'];
$portions = $_POST['portions'];
$products = $_POST['products'];
$weights = $_POST['weights'];

var_dump("POST:", $_POST);
$res = Recipe::store(
  [
    'title' => $title,
    'recipe_category_id' => $category,
    'image_url' => $image_url,
    'video_url' => $video_url,
    'description' => $description,
    'portions' => $portions
  ],
  $products,
  $weights[0] == "" ? array() : $weitghs,
);

var_dump("res:", $res);
header('Location: ../../public/pages/recipes.php');
