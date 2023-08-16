<?php

namespace App\Models;

use App\Data;

class Recipe
{
    public $id;
    public $table = "recipes";
    public $title;
    public $category_id;
    public $image_url;
    public $video_url;
    public $description;
    public $portions;
    function __construct($title, $category_id, $video_url, $image_url, $description, $portions, $id = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->category_id = $category_id;
        $this->image_url = $image_url;
        $this->video_url = $video_url;
        $this->description = $description;
        $this->portions = $portions;
    }
    public function weight()
    {
        $sum = 0;
        foreach ($this->ingredients() as $ingredient) {
            $sum += $ingredient->weight;
        }
        return $sum;
    }
    public function price()
    {
        $sum = 0;
        foreach ($this->ingredients() as $ingredient) {
            $sum += $ingredient->price();
        }
        return $sum;
    }
    public function info()
    {
        $res = [];
        if (count($this->ingredients()) != 0) {
            foreach ($this->ingredients() as $ingredient) {
                $info = $ingredient->info();
                foreach (Data::$info_data as $val) {
                    $res[$val] = $info[$val];
                }
            }
        } else {
            foreach (Data::$info_data as $val) {
                $res[$val] = 0;
            }
        }
        return $res;
    }
    public function ingredients()
    {
        return Ingredient::where('recipe_id', $this->id);
    }
    public function dishes()
    {
        return Dish::where('recipe_id', $this->id);
    }
    public function category()
    {
        return RecipeCategory::find($this->category_id);
    }
    static function find($id)
    {
        $recipe = Data::getItemById('recipes', $id);
        return new Recipe($recipe[1], $recipe[2], $recipe[3], $recipe[4], $recipe[5], $recipe[6], $recipe[0]);
    }
    static function where($foreign_key, $id)
    {
        $items = Data::getData("recipes", ' ' . $foreign_key . '=' . $id);
        $res = array();
        foreach ($items as $item) {
            array_push($res, Self::find($item[0]));
        }
        return $res;
    }
    static function all()
    {
        $recipes = Data::getData('recipes');
        $res = array();
        foreach ($recipes as $recipe) {
            array_push($res, Self::find($recipe[0]));
        }
        return $res;
    }
    public function create(array $products = [], array $weights = [])
    {
        Data::createItem('recipes', ['title' => $this->title, 'category_id' => $this->category_id, 'image_url' => $this->image_url, 'video_url' => $this->video_url, 'description' => $this->description, 'portions' => $this->portions]);
        $recipe_id = Data::getLastItemId();
        $count_weight = count($weights);
        for ($i = 0; $i < $count_weight; $i++) {
            $new_ingredient = new Ingredient($weights[$i], $recipe_id, $products[$i]);
            $new_ingredient->create();
        }
    }
    static function store_by_title(string $title)
    {
        $recipe_id = Data::createItem('recipes', ["title"=>$title,"recipe_category_id"=>16]);
        return $recipe_id != 0 ?  $recipe_id : $false;
    }
    static function store(array $data, array $products = [], array $weights = [])
    {
        $recipe_id = Data::createItem('recipes', $data);
        $count_weight = count($weights);
        for ($i = 0; $i < $count_weight; $i++) {
            $new_ingredient = new Ingredient($weights[$i], $recipe_id, $products[$i]);
            $new_ingredient->create();
        }
        return $recipe_id != 0 ? $recipe_id : $data;
    }
    public function delete()
    {
        foreach ($this->ingredients() as $ingredient) {
            $ingredient->delete();
        }
        foreach ($this->dishes() as $dish) {
            $dish->delete();
        }
        Data::deleteItem($this->table, $this->id);
    }
}
