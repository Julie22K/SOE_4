<?php

namespace App\Models;

use App\Data;
/**
 * @property int $id
 */
class User extends Model
{
    protected $table = 'users';

    public function products()
    {
        return Product::where([["user_id",$_SESSION['user']['id']]]);
    }

    public function recipes()
    {
        return Recipe::where([["user_id",$_SESSION['user']['id']]]);
    }
    
    public function menus()
    {
        return Menu::where([["user_id",$_SESSION['user']['id']]]);
    }
    
    public function shops()
    {
        return Shop::where([["user_id",$_SESSION['user']['id']]]);
    }
    
    public function manufactures()
    {
        return Manufacturer::where([["user_id",$_SESSION['user']['id']]]);
    }
    
    public function prices()
    {
        return Price::where([["user_id",$_SESSION['user']['id']]]);
    }
    
    public function persons()
    {
        return Person::where([["user_id",$_SESSION['user']['id']]]);
    }
    
    public function recipe_categories()
    {
        return RecipeCategory::where([["user_id",$_SESSION['user']['id']]]);
    }
    
    public function product_categories()
    {
        return ProductCategory::where([["user_id",$_SESSION['user']['id']]]);
    }
    
    public function mealtimes()
    {
        return MealTime::where([["user_id",$_SESSION['user']['id']]]);
    }
}
