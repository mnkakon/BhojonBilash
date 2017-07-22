<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $restaurantIds = App\Restaurant::get()->lists('id')->toArray();

        foreach ($restaurantIds as $restaurantId) {
        	for ($i=0; $i < 3 ; $i++) { 
        		$o = new App\Order();

        		$o->contact 		= $faker->phoneNumber;
                $o->address         = $faker->address;
                $o->delivered_by    = $faker->name;
        		$o->total_price		= $faker->numberBetween($min = 100, $max = 20000);
        		$o->restaurant_id 	= $restaurantId;
        		$o->save();
        	}
        }
    }
}
