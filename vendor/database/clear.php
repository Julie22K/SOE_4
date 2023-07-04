<?php

use App\DB;
use App\Models\Recipe;

require 'C:\Users\Dell\source\SOE_4\public/blocks/pre_head.php';

echo "database clear";
mysqli_query(DB::DB(), "drop table migrations;");
mysqli_query(DB::DB(), "drop table products;");
mysqli_query(DB::DB(), "drop table recipes;");
mysqli_query(DB::DB(), "drop table persons;");

mysqli_query(DB::DB(), "drop table recipe_categories;");
mysqli_query(DB::DB(), "drop table product_categories;");

mysqli_query(DB::DB(), "drop table person_in_menus;");
mysqli_query(DB::DB(), "drop table menus;");

mysqli_query(DB::DB(), "drop table dishes;");
mysqli_query(DB::DB(), "drop table ingredients;");
mysqli_query(DB::DB(), "drop table shop_items;");

mysqli_query(DB::DB(), "drop table shops;");
mysqli_query(DB::DB(), "drop table prices;");
mysqli_query(DB::DB(), "drop table manufacturers;");
mysqli_query(DB::DB(), "drop table meal_times;");


header('Location: ../../index.php');
