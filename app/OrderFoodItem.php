<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderFoodItem extends Model
{
    
    public function foodItem()
    {
    	return $this->belongsTo(FoodItem::class, 'food_id', 'id');
    }

   	public function order()
   	{
   		return $this->belongsTo(Order::class, 'order_id', 'id');
   	}
}
