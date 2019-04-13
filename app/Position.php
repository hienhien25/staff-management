<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
	protected $table="tblposition";
	protected $fillable=['position_name','description'];
    
}
