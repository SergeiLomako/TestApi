<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserDataTableSeeder extends Seeder
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
            DB::table('user_data')
                ->insert([
                    'user_id' => $i,
                    'first_name' => $faker->firstNameMale,
                    'last_name' => $faker->lastName,
                    'birth_date' => $faker->dateTime,
                    'address' => $faker->streetAddress,
                    'city' => $faker->city,
                ]);
        }
    }
}

