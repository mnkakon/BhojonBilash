<?php

use Illuminate\Database\Seeder;

class OrderFoodItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $orderIds = App\Order::get()->lists('id')->toArray();
        $foodItems = App\FoodItem::get();

        foreach ($orderIds as $orderId) {
        	$foodNumber = rand(1,4);
    		for ($i=0; $i < $foodNumber ; $i++) { 
        		$of = new App\OrderFoodItem();

        		$foodItem = $foodItems->random();

        		$of->food_id 	= $foodItem->id;
        		$of->quantity 	= $faker->randomDigit;
        		$of->price		= $foodItem->price;
        		$of->order_id 	= $orderId;
        		$of->save();
        	}
        }
    }
}
