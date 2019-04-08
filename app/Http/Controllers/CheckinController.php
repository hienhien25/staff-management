<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Checkin;
use Auth;
use App\User;
use DB;
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
    	$check->check_date=date('Y-m-d');
    	$check->save();
    	return redirect()->back();
    }
    public function getcheckout()
    {
        $user=DB::table('tblcheckin')
        ->join('users','tblcheckin.id_staff','=','users.id')
        ->select('users.*','tblcheckin.*','tblcheckin.start_hour as start_hour','tblcheckin.finish_hour as finish_hour','tblcheckin.check_date as check_date','users.fullname as fullname')
        ->paginate(12);
       /* switch ($month) {
            case 1:
             $month=Checkin::whereMonth('check_date', '=', date('1'))->get();
             for($i=1;$i<=31;$i++)
             {
                $day=Checkin::whereDay('check_date','=',date('d'))->get();
                echo "<button>".."</button>"

             }
            break;
            case 2:
            $month=Checkin::whereMonth('check_date', '=', date('2'))->get();
            break;
            case 3:
            $month=Checkin::whereMonth('check_date', '=', date('3'))->get();
            break;
            case 4:
            $month=Checkin::whereMonth('check_date', '=', date('4'))->get();
            break;
            case 5:
            $month=Checkin::whereMonth('check_date', '=', date('5'))->get();
            break;
            case 6:
            $month=Checkin::whereMonth('check_date', '=', date('6'))->get();
            break;
            default:
            echo "Bạn điền sai tháng !";
            break;
        }*/
        //dd($user);
        $month=Checkin::whereMonth('check_date', '=', date('m'))->get();
        dd($month);
        $day=Checkin::whereDate('check_date','=',date('Y-m-d'))->get();
        dd($day);
        return view('layout.user.checkout',compact('user','month'));
    }
    public function geteditcheckout($id)
    {
        $chk=Checkin::find($id);
        //dd($chk);
        return view('layout.user.editcheckout',compact('chk'));
    }
    public function posteditcheckout(Request $req,$id)
    {
        $ch=Checkin::find('id');
        $this->validate($req,
            [
                'start_hour'=>'required',
                'finish_hour'=>'required'
            ],
            [
                'start_hour.required'=>'Bạn chưa điền thời gian bắt đầu làm việc !',
                'finish_hour.required'=>'Bạn chưa điền thời gian kết thúc !'
            ]
        );
        $ch->start_hour=$req->start_hour;
        $ch->finish_hour=$req->finish_hour;
        $ch->save();
        return redirect(route('admin.checkout'));
    }
    public function getdelete($id)
    {
        $chk=Checkin::find('id');
        //dd($chk);
        $chk->delete();
        return redirect()->back();
    }
}
