<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    protected $table="tblcheckin";
    protected $fillable=['start_hour','finish_hour'];
}
