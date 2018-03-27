<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    public $primaryKey = 'id';
    protected $fillable = ['title', 'cost'];
}
