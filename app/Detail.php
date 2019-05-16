<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table="tbldetail";
    protected $fillable=['dob','larary','gender','phone','address'];
}
