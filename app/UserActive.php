<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserActive extends Model
{
     protected $table = 'user_activations';
     public function getToken()
     {
     	return hash_hmac('sha256',str_random(30), 'secret');
     }

}
