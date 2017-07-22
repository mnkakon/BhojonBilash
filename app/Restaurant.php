<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    
    public function orders()
    {
    	return $this->hasMany(Order::class, 'restaurant_id', 'id');
    }
}
