<?php

namespace App\Models;

use App\Data;
/**
 * @property int $shop_id
 * @property int $product_id
 * @property int $manufacturer_id
 */
class Price extends Model
{
    protected $table = 'prices';
    
    public function shop()
    {
        return Shop::find($this->shop_id);
    }
    public function manufacturer()
    {
        return Manufacturer::find($this->manufacturer_id);
    }
    public function product()
    {
        return Product::find($this->product_id);
    }
    
    public function user()
    {
        return User::find($this->user_id);
    }
}
