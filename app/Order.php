<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    function orderFoodItems()
    {
		return $this->hasMany(OrderFoodItem::class, 'order_id', 'id');
	}
}
