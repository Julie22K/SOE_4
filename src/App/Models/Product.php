<?php

namespace App\Models;

use App\Data;
use App\Models\Ingredient;
use App\Models\ProductCategory;
use App\Models\Price;

class Product
{
    public $id;
    public $table = "products";
    public $title;
    public $category_id;
    public $image_url;
    public $user_id;
    public $is_private;
    public $product_data = [];
    function __construct($title, $category_id, $image_url,$user_id,$is_private, $data, $id = null)
    {
        $this->id = is_null($id) ? 0 : $id;
        $this->title = $title;
        $this->category_id = $category_id;
        $this->image_url = $image_url;
        $this->product_data = $data;
        $this->user_id=$user_id;
        $this->is_private=$is_private;
    }
    public function avg_price(int $weight = 100)
    {
        $prices = $this->prices();
        $number = count($prices);
        $sum = 0;
        foreach ($prices as $price) {
            $sum += $price->price / $price->weight;
        }
        if ($number != 0) return round(($sum / $number) * $weight, 2);
        else return 0;
    }
    public function ingredients()
    {
        return Ingredient::where('product_id', $this->id);
    }
    public function category()
    {
        return ProductCategory::find($this->category_id);
    }
    public function shop_items()
    {
        return ShopItem::where('product_id', $this->id);
    }
    public function prices()
    {
        return Price::where('product_id', $this->id);
    }
    static function find($id)
    {
        $product = Data::getItemById('products', $id);
        $product_data = array('kcal' => $product[6], 'water' => $product[7], 'cellulose' => $product[8], 'fat' => $product[9], 'carb' => $product[10], 'protein' => $product[11], 'vitA' => $product[12], 'vitE' => $product[13], 'vitK' => $product[14], 'vitD' => $product[15], 'vitC' => $product[16], 'om3' => $product[17], 'om6' => $product[18], 'vitB1' => $product[19], 'vitB2' => $product[20], 'vitB5' => $product[21], 'vitB6' => $product[22], 'vitB8' => $product[23], 'vitB9' => $product[24], 'vitB12' => $product[25], 'minMg' => $product[26], 'minNa' => $product[27], 'minCa' => $product[28], 'minCl' => $product[29], 'minK' => $product[30], 'minS' => $product[31], 'minP' => $product[32], 'minI' => $product[33], 'minCu' => $product[34], 'minCr' => $product[35]);
        return new Product($product[1], $product[2], $product[3],$product[4],$product[5], $product_data, $product[0]);
    }
    static function where($foreign_key, $id)
    {
        $items = Data::getData("product_categories", ' ' . $foreign_key . '=' . $id);
        $res = array();
        foreach ($items as $item) {
            array_push($res, Self::find($item[0]));
        }
        return $res;
    }
    static function paginate($number)
    {
        $items = Data::getDataWithLimit("products",$number);
        $res = array();
        foreach ($items as $item) {
            array_push($res, Self::find($item[0]));
        }
        return $res;
    }
    static function all()
    {
        $products = Data::getData('products');
        $res = array();
        foreach ($products as $product) {
            array_push($res, Self::find($product[0]));
        }
        return $res;
    }
    static function allByUser($user_id)
    {
        $products = Data::getData('products','(is_private=true AND user_id IS NULL) OR user_id=' . $user_id);
        $res = array();
        foreach ($products as $product) {
            array_push($res, Self::find($product[0]));
        }
        return $res;
    }
    public function create(array $prices = [], array $weights = [], array $manufacturers = [], array $shops = [])
    {
        $product_id = Data::createItem('products', array_merge(['title' => $this->title, 'product_category_id' => $this->category_id, 'image_url' => $this->image_url], $this->product_data));
        echo 'PRODUCT_ID' . $product_id;
        if (count($weights) == 0) {
            foreach ($prices as $price) {
                if ($price instanceof Price) $price->create();
                else Price::store(array_merge($price, ['product_id' => $product_id]));
            }
        } else {

            $count_prices = count($prices);
            for ($i = 0; $i < $count_prices; $i++) {
                $new_price = new Price($prices[$i], $weights[$i], $product_id, $manufacturers[$i], $shops[$i]);
                $new_price->create();
            }
        }
        return $product_id != 0 ? true : array_merge(['title' => $this->title, 'category_id' => $this->category_id, 'image_url' => $this->image_url], $this->product_data);
    }
    static function store(array $data, array $prices = [], array $weights = [], array $manufactures = [], array $shops = [])
    {
        Data::createItem('products', $data);
        $product_id = Data::getLastItemId();
        if (count($weights) == 0) {
            foreach ($prices as $price) {
                if ($price instanceof Price) $price->create();
                else Price::store(array_merge($price, ['product_id' => $product_id]));
            }
        } else {
            $count_prices = count($prices);
            for ($i = 0; $i < $count_prices; $i++) {
                $new_price = new Price($prices[$i], $weights[$i], $product_id, $manufactures[$i], $shops[$i]);
                $new_price->create();
            }
        }
    }
    public function delete()
    {
        foreach ($this->prices() as $price) {
            $price->delete();
        }
        foreach ($this->ingredients() as $ingredient) {
            $ingredient->delete();
        }
        Data::deleteItem($this->table, $this->id);
    }
}
