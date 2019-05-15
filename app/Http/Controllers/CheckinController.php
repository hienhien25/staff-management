<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Checkin;
use Auth;
use App\User;
use DB;
use App\Statistics;
use App\Http\Requests\CheckinRequest;
use App\Time;
use Session;
class CheckinController extends Controller
{
    public function getCheckin()
    {
    	$dt = Carbon::now('Asia/Ho_Chi_Minh');
    	return view('layout.user.checkin',compact('dt'));
    }
    public function postCheckin(CheckinRequest $req)
    {
        $m=Carbon::now()->month;
        $time=Time::where('month',$m)->first();
        // Kiểm tra xem trong bảng thống kê đã có record lưu thống kê của user trong thangs hiện tại chưa 
        $check=Statistics::where('id_staff',Auth::user()->id)
                            ->where('id_month',$time->id)
                            ->get();
        //dd($check);
        if(!empty($check))// Nếu ko có 
        {
            //Lưu thêm trường này vào tblstatistic
            $sta= new Statistics();
            $sta->id_month=$time->id;
            $sta->id_staff =Auth::user()->id;
            if(!$sta->save())
            {
                throw new Exception("System Error ", 1);     
            }
        }
        $month=Statistics::where('id_month',$time->id)
                        ->where('id_staff',Auth::user()->id)
                        ->first();
       //dd($month);  
    	$check= new Checkin;
        $check->fill($req->all());
        $check->id_statist=$month->id;
    	$check->check_date=date('Y-m-d');
    	if(!$check->save())
        {
            throw new Exception("Error ", 1);  
        }

    	return response()->json(['success'=>'Successfully!']);
    }
    public function showList(Request $req)
    {
        $user=DB::table('tblcheckin')
        ->join('tblstatistic','tblcheckin.id_statist','=','tblstatistic.id')
        ->leftjoin('users','tblstatistic.id_staff','=','users.id')
        ->select('users.*','tblcheckin.*','tblstatistic.*','tblcheckin.start_hour as start_hour','tblcheckin.finish_hour as finish_hour','tblcheckin.check_date as check_date','users.fullname as fullname')
        ->paginate(12);   
        $mon=\App\Time::all();  
        //dd($mon);
        return view('layout.user.show_checkin_list ',compact('user','mon'));
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
        if(!$ch->save())
        {
            throw new Exception("System Error", 1);  
        }
        return redirect(route('admin.checkout'));
    }
    public function getDelete($id)
    {
        $chk=Checkin::find($id);
        //dd($chk);
        if(!$chk->delete())
        {
            throw new Exception("System Error", 1);
        }
        return redirect()->back();
    }
}
