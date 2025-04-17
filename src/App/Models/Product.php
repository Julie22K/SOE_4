<?php

namespace App\Models;

use App\Data;
use App\Models\Ingredient;
use App\Models\ProductCategory;
use App\Models\Price;
use App\Models\Model;

/**
 * @property string $title
 * @property int $product_category_id
 * @property string $image_url
 * @property int $user_id
 * @property bool $is_private
 * @property int $kcal
 * @property int $water
 * @property int $cellulose
 * @property int $fat
 * @property int $carb
 * @property int $protein
 * @property int $vitA
 * @property int $vitE
 * @property int $vitK
 * @property int $vitD
 * @property int $vitC
 * @property int $om3
 * @property int $om6
 * @property int $vitB1
 * @property int $vitB2
 * @property int $vitB5
 * @property int $vitB6
 * @property int $vitB8
 * @property int $vitB9
 * @property int $vitB12
 * @property int $minMg
 * @property int $minNa
 * @property int $minCa
 * @property int $minCl
 * @property int $minK
 * @property int $minS
 * @property int $minP
 * @property int $minI
 * @property int $minCu
 * @property int $minCr
 */
class Product extends Model
{
    protected $table = 'products';

    public function avg_price(int $weight = 100)
    {
        $prices = $this->prices();
        $number = count($prices);
        // pre($prices);
        // echo $number;
        $sum = 0;
        foreach ($prices as $price) {
            if ($price->weight != 0) $sum += $price->price / $price->weight;
            else $number--;
        }
        if ($number != 0)
            return round(($sum / $number) * $weight, 2);
        else
            return 0;
    }

    public function ingredients()
    {
        return Ingredient::where([['product_id', $this->id]]);
    }

    public function category()
    {
        return ProductCategory::find($this->product_category_id);
    }

    public function shop_items()
    {
        return ShopItem::where([['product_id', $this->id]]);
    }
    public function prices()
    {
        return Price::where([['product_id', $this->id]]);
    }

    static function paginate($number)
    {
        $items = Data::getDataWithLimit("products", $number);
        $res = array();
        foreach ($items as $item) {
            array_push($res, self::find($item[0]));
        }
        return $res;
    }
}
