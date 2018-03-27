<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [1,2,3,4,5,6,7,8,9];
        $moderator = [2,10,9,11,12];

        foreach($admin as $item) {
            DB::table('permission_role')
                ->insert([
                    'role_id' => 2,
                    'permission_id' => $item,
                ]);
        }

        foreach($moderator as $item) {
            DB::table('permission_role')
                ->insert([
                    'role_id' => 3,
                    'permission_id' => $item,
                ]);
        }
    }
}
