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
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UserDataTableSeeder::class);
        $this->call(ServiceTableSeeder::class);
        $this->call(TerminalTableSeeder::class);
        $this->call(OrderTableSeeder::class);
    }
}
