<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'email', 'password', 'tel'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function data()
    {
        return $this->hasOne('App\UserData');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public static function getToResetToken($token)
    {
        return self::wherePasswordResetToken($token)->first();
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function setTelAttribute($value)
    {
        $this->attributes['tel'] = preg_replace('![^0-9]+!', '', $value);
    }

    public function routeNotificationForSmscru()
    {
        return preg_replace('![^0-9]+!', '', $this->tel);
    }

    public static function search($user, $search)
    {
        $do_not_searching = \App\Helpers\MyHelper::doNotSearching($user);
        return self::whereNotIn('id', $do_not_searching)->whereHas('data', function ($query) use ($search, $user) {
            $query->where('first_name', 'like', $search)
                ->orWhere('last_name', 'like', $search)
                ->orWhere('tel', 'like', $search)
                ->when($user->hasRole('super_admin'), function ($query) use ($search) {
                    $query->orWhere('city', 'like', $search);
                    $query->orWhere('address', 'like', $search);
                });
        })->when($user->hasRole('super_admin'), function ($query) use ($search) {
            $query->orWhereHas('roles', function ($query) use ($search) {
                $query->where('display_name', 'like', $search);
            });
        })->paginate(env('PAGINATE_LIMIT'));
    }

    public static function getList($not_searching, $field, $sort)
    {
        return self::leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('user_data', 'users.id', '=', 'user_data.user_id')
            ->whereNotIn('users.id', $not_searching)
            ->orderBy($field, $sort)
            ->paginate(env('PAGINATE_LIMIT'));
    }

}
