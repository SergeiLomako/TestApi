<?php

namespace App;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public static function role_list(){
        return [0 => ' ',
                2 => 'Админ',
                3 => 'Модератор'];
    }
}
