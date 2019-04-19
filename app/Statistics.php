<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Checkin;
class Statistics extends Model
{
	protected $table='tblstatistic';
	public function addMonth()
	{
		$m=new Statistics();
		$m->month=$month+1;
		$m->save();
	}
	public function increasingMonth()
	{
		$day=Carbon::now()->day;
		$month=Carbon::now()->month;
		$year=Carbon::now()->year;
		switch($month){
			case 1,3,5,7,8,10,12:
			{
				if($day==31)
				{
					addMonth();
				}
				break();
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
				
				break();
			}
			case 4,6,9,11:
			{
				if($day==30)
				{
					addMonth();
				}
				break();
			}
			default:
			break();
		}
	}
}
