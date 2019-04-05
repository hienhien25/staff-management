<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Checkin;
use Auth;
class CheckinController extends Controller
{
    public function getcheckin()
    {
    	$dt = Carbon::now('Asia/Ho_Chi_Minh');
    	return view('layout.user.checkin',compact('dt'));
    }
    public function postcheckin(Request $req)
    {
    	$check= new Checkin;
    	$check->id_staff=Auth::user()->id;
    	$check->start_hour=$req->start_hour;
    	$check->finish_hour=$req->finish_hour;	
    	$check->check_date=date('m-d-Y');
    	$check->save();
    	return redirect(route('home'));
    }
}
