<?php

use Illuminate\Database\Seeder;

class FoodItemsTableSeeder extends Seeder
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
		$catagoryIds = App\Catagory::get()->lists('id')->toArray();

        foreach ($restaurantIds as $restaurantId) {
	    	foreach ($catagoryIds as $catagoryId)
	    	{
	    		for ($j=0; $j < 5; $j++) { 
	    			$fi = new App\FoodItem();
		    		$fi->name 			= $faker->name;
		    		$fi->price 			= $faker->numberBetween($min = 100, $max = 20000);
		    		$fi->image 			= $faker->imageUrl($width = 640, $height = 480);
		    		$fi->person_count 	= $faker->numberBetween($min = 1, $max = 4);
		    		$fi->ingredients	= $faker->text($maxNbChars = 200);
		    		$fi->is_special 	= $faker->boolean;
		    		$fi->description 	= $faker->text($maxNbChars = 200);
		    		$fi->restaurant_id 	= $restaurantId;
		    		$fi->category_id 	= $catagoryId;
		    		$fi->save();
	    		}
	    	}
	    }
    }
}
