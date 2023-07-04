<?php

use App\Models\Recipe;

require 'C:\Users\Dell\source\SOE_4\public/blocks/pre_head.php';


$id = $_GET['id'];

Recipe::find($id)->delete();



header('Location: ../../public/pages/recipes.php');
