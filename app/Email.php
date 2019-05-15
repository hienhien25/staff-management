<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table='tblemail';
    protected $fillable=['title','user_recive'];
}
