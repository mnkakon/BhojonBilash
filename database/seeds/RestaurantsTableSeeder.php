<?php

use Illuminate\Database\Seeder;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create();

    	for ($i=0; $i < 5; $i++)
    	{
    		$r = new App\Restaurant();
    		$r->name = $faker->company;
    		$r->logo = $faker->imageUrl($width = 640, $height = 480);
    		$r->website = $faker->url;
    		$r->address = $faker->address;
    		$r->phone = $faker->phoneNumber;
    		$r->email = $faker->email;
    		$r->save();
    	}
    }
}
