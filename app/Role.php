<?php

namespace App;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public static function roleList(){
        return [0 => ' ',
                2 => 'Админ',
                3 => 'Модератор'];
    }
}
