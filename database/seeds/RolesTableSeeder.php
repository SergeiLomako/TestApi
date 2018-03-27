<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['super_admin' => 'Супер Админ','admin' => 'Админ', 'moderator' => 'Модератор'];
        foreach ($roles as $key => $val) {
           Role::create(['name' => $key, 'display_name' => $val]);
        }
    }
}
