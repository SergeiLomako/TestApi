<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terminal extends Model
{
    protected $table = 'terminals';
    public $primaryKey = 'id';
    protected $fillable = ['address'];

}
