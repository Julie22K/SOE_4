<?php

namespace App\Models;

use App\Data;
/**
 * @property int $id
 * @property int $title
 * @property int $recipe_category_id
 * @property int $video_url
 * @property int $image_url
 * @property int $description
 * @property int $portions
 * @property int $user_id
 * @property int $is_private
 */
class Recipe extends Model
{
    protected $table = 'recipes';
    
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
        return Ingredient::where([['recipe_id', $this->id]]);
    }
    public function dishes()
    {
        return Dish::where([['recipe_id', $this->id]]);
    }
    public function category()
    {
        return RecipeCategory::find($this->recipe_category_id);
    }
    // FIXME:
    // static function store_by_title(string $title)
    // {
    //     $recipe_id = Data::createItem('recipes', ["title"=>$title,"recipe_category_id"=>16]);
    //     return $recipe_id != 0 ?  $recipe_id : $false;
    // }
}
