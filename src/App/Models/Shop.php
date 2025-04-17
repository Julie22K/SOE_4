<?php

namespace App\Models;

use App\Data;

class Shop extends Model
{
    protected $table = 'shops';
    
    public function prices(int $limit=null, string $order_by=null)
    {   
        $order_by_str = $order_by ? "ORDER BY $order_by" : "";
        $limit_str = $limit ? "LIMIT $limit" : "";
        return Price::where([['shop_id', $this->id, $order_by_str . ' ' . $limit_str]]);
    }
    
    public function user()
    {
        return User::find($this->user_id);
    }
}
