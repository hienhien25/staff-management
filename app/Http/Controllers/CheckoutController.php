<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Checkin;
use Auth;
use App\Statistics;
use App\Http\Requests\CheckinRequest;
use Carbon\Carbon;
use App\Checkout;
use App\Time;
use App\Log;
use App\TimeLog;
use App\DetailTimeLog;
use DB;

class CheckoutController extends Controller
{
    public function getCheckout()
    {
        $m=Carbon::now()->month;
        $date=date('Y-m-d');
        $time=Time::where('month', $m)->first();
        $stat=Statistics::where('id_month', $time->id)
                        ->where('id_staff', Auth::user()->id)
                        ->first();
        //dd($stat);
        $check=Checkin::where('id_statist', $stat->id)
                        ->where('check_date', $date)
                        ->first();
        return view('layout.user.checkout', compact('check'));
    }
    public function postCheckout(Request $req)
    {
        DB::beginTransaction();
        try {
            $m=Carbon::now()->month;
            $time=Time::where('month', $m)->first();
            $month=Statistics::where('id_month', $time->id)
                            ->where('id_staff', Auth::user()->id)
                            ->first();
            //dd($month->id);
            $date=date('Y-m-d');
            $check=Checkin::where('id_statist', $month->id)
                        ->where('check_date', $date)
                        ->first();
            //dd($check);
            $check->finish_hour=$req->finish_hour;
            $check->status=1;
            if (!$check->save()) {
                throw new Exception(" System Error ", 1);
            }
            $stat=new Checkout();
            $stat->add();
            $log= new Log();
            $log->id_staff=Auth::user()->id;
            $log->datetime_log=Carbon::now('Asia/Ho_Chi_Minh');
            $log->action='Checkout';
            $log->save();
            $t=TimeLog::where('user_id', Auth::user()->id)
                          ->where('check_date', $date)
                          ->first();
            //dd($t);
            $t->status=1;
            $t->save();
            $dtl=DetailTimeLog::where('id_timelog', $t->id)->first();
            //dd($dtl);
            $dtl->checkout_time=Carbon::now('Asia/Ho_Chi_Minh');
            $dtl->save();
            DB::table('tblstatistic')
            ->select(DB::raw('SELECT id_statist, SUM(MINUTE(`finish_hour` - `start_hour`)) FROM `tblcheckin` WHERE MONTH(`check_date`) = $m AND `id_statist` = $id_statist'));
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception("Error Processing Request", 1);
        }
        return response()->json(['success'=>'Successfully!']);
    }
}
