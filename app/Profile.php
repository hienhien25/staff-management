<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function getToken()
    {
        return hash_hmac('sha256', str_random(30), 'secret');
    }
}
