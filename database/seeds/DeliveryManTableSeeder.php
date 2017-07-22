<?php

use Illuminate\Database\Seeder;

class DeliveryManTableSeeder extends Seeder
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

        foreach ($orderIds as $orderId) {
			$dm = new App\DeliveryMan();
			$dm->name = $faker->name;
			$dm->contact = $faker->phoneNumber;
			$dm->delivering_area = $faker->address;
    		$dm->save();
		}
    }
}
