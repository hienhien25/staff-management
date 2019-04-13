<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Checkin;
use Auth;
use App\User;
use DB;
use App\Http\Requests\CheckinRequest;
class CheckinController extends Controller
{
    public function getCheckin()
    {
    	$dt = Carbon::now('Asia/Ho_Chi_Minh');
    	return view('layout.user.checkin',compact('dt'));
    }
    public function postCheckin(CheckinRequest $req)
    {
    	$check= new Checkin;
        $check->fill($req->all());
    	$check->id_staff=Auth::user()->id;
    	$check->check_date=date('Y-m-d');
    	$check->save();
    	return redirect()->back();
    }
    public function getCheckout(Request $req)
    {
        $user=DB::table('tblcheckin')
        ->join('users','tblcheckin.id_staff','=','users.id')
        ->select('users.*','tblcheckin.*','tblcheckin.start_hour as start_hour','tblcheckin.finish_hour as finish_hour','tblcheckin.check_date as check_date','users.fullname as fullname')
        ->paginate(12);
        $mon=$req->month;
        //dd($mon);
        switch ($mon) {
            case 0:
                return view('layout.user.checkout ',compact('user'));
                break;
            case 1:
            {
             $mon=Checkin::whereMonth('check_date', '=', date('1'))->get();
            //dd($mon)
            return view('layout.user.checkout ',compact('mon','user'));
            }
            break;
            case 2:
            {
             $mon=Checkin::whereMonth('check_date', '=', date('2'))->get();
            
            return view('layout.user.checkout ',compact('mon','user'));
            break;
            }
            case 3:
            {
             $mon=Checkin::whereMonth('check_date', '=', date('3'))->get();    
            return view('layout.user.checkout ',compact('mon','user'));
            break;
            }
            case 4:
            {
             $mon=Checkin::whereMonth('check_date', '=', date('4'))->get();
            
            return view('layout.user.checkout ',compact('mon','user'));
            break;
            }
            case 5:
           {
             $mon=Checkin::whereMonth('check_date', '=', date('5'))->get();
            
            return view('layout.user.checkout ',compact('mon','user'));
            break;
            }
            case 6:
           {
             $mon=Checkin::whereMonth('check_date', '=', date('6'))->get();
            
            return view('layout.user.checkout ',compact('mon','user'));
            break;
            }
            default:
            echo "Bạn điền sai tháng !";
            //break;
        }
        //dd($user);
        /*$mon=Checkin::whereMonth('check_date', '=', date('m'))->get();
        dd($mon);
        $day=Checkin::whereDate('check_date','=',date('Y-m-d'))->get();
        dd($day);*/
        //return view('layout.user.checkout',compact('user'));
    }
    public function getEditCheckout($id)
    {
        $chk=Checkin::find($id);
        //dd($chk);
        return view('layout.user.edit_checkout',compact('chk'));
    }
    public function postEditCheckout(CheckinRequest $req,$id)
    {
        $ch=Checkin::find($id);
        $ch->fill($req->all());
        $ch->save();
        return redirect(route('admin.checkout'));
    }
    public function getDelete($id)
    {
        $chk=Checkin::find($id);
        //dd($chk);
        $chk->delete();
        return redirect()->back();
    }
}
