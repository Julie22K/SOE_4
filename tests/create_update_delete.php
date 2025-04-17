<?php
namespace App;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'C:\Users\Laptopchik\source\soe4\SOE_4\vendor\autoload.php';

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
echo '<h1>Tests:</h1>';
$data_create=[
    "create products"=>Product::all(),
    "create recipes"=>Recipe::all(),
    "create ingredients"=>Ingredient::all(),
    "create persons in menu"=>PersonInMenu::all(),
    "create prices"=>Price::all(),
    "create shops"=>Shop::all(),
    "create shop items"=>ShopItem::all(),
    "create menus"=>Menu::all(),
    "create persons"=>Person::all(),
    "create dishes"=>Dish::all(),
    "create meal times"=>MealTime::all(),
    "create manufacturers"=>Manufacturer::all(),
    "create recipe categories"=>RecipeCategory::all(),
    "create product categories"=>ProductCategory::all(),
];
$data_update=[
    "update products"=>Product::all(),
    "update recipes"=>Recipe::all(),
    "update ingredients"=>Ingredient::all(),
    "update persons in menu"=>PersonInMenu::all(),
    "update prices"=>Price::all(),
    "update shops"=>Shop::all(),
    "update shop items"=>ShopItem::all(),
    "update menus"=>Menu::all(),
    "update persons"=>Person::all(),
    "update dishes"=>Dish::all(),
    "update meal times"=>MealTime::all(),
    "update manufacturers"=>Manufacturer::all(),
    "update recipe categories"=>RecipeCategory::all(),
    "update product categories"=>ProductCategory::all(),
];
$data_delete=[
    "delete products"=>Product::all(),
    "delete recipes"=>Recipe::all(),
    "delete ingredients"=>Ingredient::all(),
    "delete persons in menu"=>PersonInMenu::all(),
    "delete prices"=>Price::all(),
    "delete shops"=>Shop::all(),
    "delete shop items"=>ShopItem::all(),
    "delete menus"=>Menu::all(),
    "delete persons"=>Person::all(),
    "select dishes"=>Dish::all(),
    "delete meal times"=>MealTime::all(),
    "delete manufacturers"=>Manufacturer::all(),
    "delete recipe categories"=>RecipeCategory::all(),
    "delete product categories"=>ProductCategory::all(),
];


foreach ($data as $key => $array) {
    echo '<h4>' . $key . '</h4>';
    echo '<pre>';
        print_r($array);
    echo '</pre>';
}







