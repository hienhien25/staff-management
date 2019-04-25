<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Statistics;
use App\User;
use DB;
use App\Checkin;
class StatisticController extends Controller
{
    public function getShowListPerMonth()
    {
    	$m=Carbon::now()->month;
    	$month=DB::table('tblstatistic')
    			->join('tbltime','tblstatistic.id_month','=','tbltime.id')
    			->rightjoin('users','tblstatistic.id_staff','=','users.id')
    			->where('tbltime.month',$m)
    			->select('tblstatistic.*','tbltime.*','users.*','tbltime.month as month','tblstatistic.id_staff as id_staff','tblstatistic.total_working_hour as total_working_hour','users.fullname as fullname')
    			->paginate(12);
    	//dd($month);
    	return view('layout.user.list_checkout_per_month',compact('month'));
    }
    public function getSearch(Request $req)
    {
    	$user=DB::table('tblcheckin')
		        ->join('tblstatistic','tblcheckin.id_statist','=','tblstatistic.id')
		        ->leftjoin('users','tblstatistic.id_staff','=','users.id')
		        ->where('tblcheckin.check_date',$req->keyword)
		        ->select('users.*','tblcheckin.*','tblstatistic.*','tblcheckin.start_hour as start_hour','tblcheckin.finish_hour as finish_hour','tblcheckin.check_date as check_date','users.fullname as fullname','tblcheckin.status as status')
		        ->paginate(12);   
		        //dd($user);
		$month=\App\Time::all();  
    	return view('layout.user.list_checkout_per_day',compact('user','month'));
    }
}
