<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Statistics;
use Carbon\Carbon;
use Auth;
use App\Checkin;
use App\Time;
class Checkout extends Model
{
    protected $table='tblcheckout';
    public $totalpermonth=0;
    public $totalleavemonth=0;
   /* public function __construct()
    {
    	$this->totalpermonth= $totalpermonth;
    }*/
    public function add()
    {
        $totalpermonth=0;
        $totalleavemonth=0;
       // echo "string";
        $m=Carbon::now()->month;
        $date=date('Y-m-d');
        $time=Time::where('month',$m)->first();
        $month=Statistics::where('id_month',$time->id)
        ->where('id_staff',Auth::user()->id)
        ->first();
        $check=Checkin::where('id_statist',$month->id)
        ->where('check_date',$date)
        ->first();
            //dd($check);
        $start=Carbon::create($check->start_hour);
        $finish=Carbon::create($check->finish_hour);
        $totalperday=$finish->diffInMinutes($start);
        $totalleaveday=(8*60-$totalperday);
        if($totalleaveday>=0)
        {
            $totalleavemonth+=$totalleaveday;
        }
            //dd($totalperday);
        $totalpermonth+=$totalperday;
            //dd($totalpermonth);
        
        $stat=Statistics::where('id',$check->id_statist)->first();
            //dd($stat);
        $stat->total_working_hour+=$totalpermonth;
        $stat->total_leave_hour+=$totalleavemonth;
        if(!$stat->save())
        {
            throw new Exception("System Error", 1);
            
        }
    }
}
