<?php

use Illuminate\Database\Seeder;

class CatagoriesTableSeeder extends Seeder
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
            for ($i=0; $i < 5; $i++)
            {
                $c = new App\Catagory();
                $c->category_name = $faker->firstName;
                $c->restaurant_id = $restaurantId;
                $c->save();
            }
        }
    }
}
