<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserData extends Model
{
    use Notifiable;

    protected $table = 'user_data';
    public $primaryKey = 'id';
    protected $fillable = ['first_name', 'last_name', 'address', 'city'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getFullNameAttribute(){
        return $this->last_name . ' ' . $this->first_name;
    }
}
