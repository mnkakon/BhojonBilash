<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RestaurantsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CatagoriesTableSeeder::class);
        $this->call(FoodItemsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(OrderFoodItemsTableSeeder::class);
        $this->call(DeliveryManTableSeeder::class);
    }
}
