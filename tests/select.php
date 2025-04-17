<?php
namespace App;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'C:\Users\Laptopchik\source\soe4\SOE_4\vendor\autoload.php';

if (!isset($_SESSION['user'])) {
    header('Location: /');
    exit();
}
use App\Migrations\Migration;
use App\Models\Product;

$migration = new Migration();
$migration->run();

use App\Models\Recipe;
use App\Models\Menu;
use App\Models\Person;
use App\Models\Dish;
use App\Models\Ingredient;
use App\Models\Export;
use App\Models\Manufacturer;
use App\Models\MealTime;
use App\Models\PersonInMenu;
use App\Models\Price;
use App\Models\Shop;
use App\Models\ShopItem;
use App\Models\User;
use App\Models\RecipeCategory;
use App\Models\ProductCategory;
//tests
//TODO:
//1.user by in 
// products 
// recipes 
// menus
// shops
// manufactures
// prices
// persons
// categories 
// mealtimes

echo '<h1>Tests:</h1>';
$data=[
    // "select products"=>Product::all(),
    "select recipes"=>Recipe::all(),
    "select ingredients"=>Ingredient::all(),
    "select persons in menu"=>PersonInMenu::all(),
    "select prices"=>Price::all(),
    "select shops"=>Shop::all(),
    "select shop items"=>ShopItem::all(),
    "select menus"=>Menu::all(),
    // "select persons"=>Person::all(),
    "select dishes"=>Dish::all(),
    "select meal times"=>MealTime::all(),
    "select manufacturers"=>Manufacturer::all(),
    "select recipe categories"=>RecipeCategory::all(),
    "select product categories"=>ProductCategory::all(),
];


foreach ($data as $key => $array) {
    echo '<h4>' . $key . '</h4>';
    echo '<pre>';
        print_r($array);
    echo '</pre>';
}







