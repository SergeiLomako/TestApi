<?php

use App\User;
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

        $faker = \Faker\Factory::create();
        for($i = 1; $i < 10; $i++) {
            $user = new User();
            $user->login = $faker->word;
            $user->password = 'qwerty';
            $user->email = $faker->email;
            $user->tel = '38099111'.rand(10,99).rand(10,99);
            $user->save();
        }
    }
}
