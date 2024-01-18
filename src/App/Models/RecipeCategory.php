<?php

namespace App\Models;

use App\Data;

class RecipeCategory
{
    public $id;
    public $table = "recipe_categories";
    public $name;
    function __construct($name, $id = null)
    {
        $this->id = $id;
        $this->name = $name;
    }
    public function recipes()
    {
        return Recipe::where('category_id', $this->id);
    }
    static function find($id)
    {
        $recipe_category = Data::getItemById('recipe_categories', $id);
        return new RecipeCategory($recipe_category[1], $recipe_category[0]);
    }
    static function where($foreign_key, $id)
    {
        $items = Data::getData("recipe_categories", ' ' . $foreign_key . '=' . $id);
        $res = array();
        foreach ($items as $item) {
            array_push($res, Self::find($item[0]));
        }
        return $res;
    }
    static function all()
    {
        $recipe_categories = Data::getData('recipe_categories');
        $res = array();
        foreach ($recipe_categories as $recipe_category) {
            array_push($res, Self::find($recipe_category[0]));
        }
        return $res;
    }
    public function create()
    {
        Data::createItem('recipe_categories', ['name' => $this->name]);
    }
    static function store($data)
    {
        Data::createItem('recipe_categories', $data);
    }
    public function delete()
    {
        Data::deleteItem($this->table, $this->id);
    }
}
