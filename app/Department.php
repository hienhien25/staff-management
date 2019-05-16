<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table='tbldepartment';
    protected $fillable=['department_name','quantity'];
    public function relaStaff()
    {
        return $this->hasMany('App\User', 'id_department');
    }
    public function relaPosition()
    {
        return $this->hasMany('App\Position', 'id_department');
    }
}
