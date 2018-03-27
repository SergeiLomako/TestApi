<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for($i = 0; $i < 20; $i++) {
            DB::table('orders')
                ->insert([
                    'user_id' => rand(1, 9),
                    'service_id' => rand(1, 3),
                    'terminal_id' => rand(1, 5),
                    'title' => $faker->realText(),
                    'date_receipt' => Carbon::now(),
                    'date_complete' => Carbon::now()->addWeeks(1 + $i),
                    'status' => rand(0, 1),
                    'payment' => rand(0, 1),
                    'payment_status' => rand(0, 1),
                    'box_number' => rand(100, 4000),
                    'seal_number' => rand(100, 4000),
                ]);
        }
    }
}
