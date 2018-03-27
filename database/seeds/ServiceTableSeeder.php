<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = ['Химчистка', 'Покраска', 'Ремонт'];

        foreach( $services as $service) {
            DB::table('services')
                ->insert([
                    'title' => $service,
                    'cost' => rand(200, 300),
                ]);
        }
    }
}
