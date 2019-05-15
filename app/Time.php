<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Time;
use Carbon\Carbon;
use App\Checkin;
use App\Statistics;
use App\User;
class Time extends Model
{
	protected $table='tbltime';
	public function increasingMonth()
	{
		$month=Carbon::now()->month;
		$nextmon=Carbon::now()->addMonth()->month;
		//dd($nextmon);
		$m=Time::where('month',$nextmon)->first();
		//dd(isset($m));
		if(!isset($m)){
			$d=Carbon::now()->daysInMonth;
			//dd($d);
			$day=Carbon::now()->day;
			//dd($day);
			if($day==$d)
			{
				$m=new Time();
				$m->month=Carbon::now()->addMonth()->month;
				$m->save();
			}
		}
		
	}
}
