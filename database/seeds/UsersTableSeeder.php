<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        /*$u = new App\User();

        $u->name = 'Admin';
        $u->role = 'Admin';
        $u->password = '1';
        $u->save();
*/
        $restaurantIds = App\Restaurant::get()->lists('id')->toArray();

    	foreach ($restaurantIds as $restaurantId) {
    		for ($i=1; $i < 3; $i++) 
    		{ 
    			$u = new App\User();
	    		$u->name = $faker->name;

	    		if ($i == 1) {
	    			$u->role = 'Manager';
	    		}
	    		else {
	    			$u->role = 'Owner';
	    		}
                $u->img = $faker->imageUrl($width = 640, $height = 480);
	    		$u->email = $faker->email;
	    		$u->password = bcrypt(1);
	    		$u->contact = $faker->phoneNumber;
	    		$u->restaurant_id = $restaurantId;
	    		$u->save();
    		}
    	}
    }
}
