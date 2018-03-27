<?php

namespace App\Providers;

use Schema;
use App\User;
use App\Role;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('users')){
            $roles = Role::all();
            if($roles->isNotEmpty()){
                $check = User::whereHas('roles', function ($query){
                             $query->whereName('super_admin');
                         })->first();
                if(empty($check)){
                    $super_admin = new User();
                    $super_admin->email = 'admin@admin.com';
                    $super_admin->password = '12345678';
                    $super_admin->save();
                    $super_admin->attachRole('super_admin');
                }
            }
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
