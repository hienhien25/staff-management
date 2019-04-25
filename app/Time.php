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
		$m=Time::where('month',$month+1)->first();
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
		
		/*$day=Carbon::now()->day;
		$month=Carbon::now()->month;
		$year=Carbon::now()->year;
		switch($month){
			case 1:
			case 3:
			case 5:
			case 7:
			case 8:
			case 10:
			case 12:
			{
				if($day==31)
				{
					addMonth();
				}
				break;
			}
			case 2:
			{
				//Kiểm tra năm nhuận 
				if($year %100==0){
					if($year %400){
						//Nếu năm hiện tại là năm nhuận 
						if($day==29)//Ngày hiện tại =29 thì save thêm tháng tới vào DB
						{
							addMonth();
						}
					}else{//Không phải năm nhuận 
						if($day==28)//Ngày hiện tại =28 thì save thêm tháng tới vào DB
						{
							addMonth();
						}
					}
				}else if($year %4==0){
					if($day==29)
					{
						addMonth();
					}
				}else{
					if($day==28)
					{
						addMonth();
					}
				}
				
				break;
			}
			case 4:
			case 6:
			case 9:
			case 11:
			{
				if($day==22)
				{
					addMonth();
				}
				break;
			}
			default:
			break;
		}*/
	}
}
