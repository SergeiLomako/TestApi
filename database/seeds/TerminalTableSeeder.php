<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TerminalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = \Faker\Factory::create();

        for($i = 0; $i < 5; $i++) {
            DB::table('terminals')
                ->insert([
                    'address' => $faker->address,
                ]);
        }
    }
}
