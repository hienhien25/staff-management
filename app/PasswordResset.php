<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordResset extends Model
{
    protected $table='password_resets';
    protected $fillable = ['email', 'token'];
    public function getToken()
    {
        return hash_hmac('sha256', str_random(30), 'secret');
    }
}
