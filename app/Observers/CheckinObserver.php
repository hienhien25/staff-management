<?php

namespace App\Observers;

use App\Checkin;
use App\Log;
use App\TimeLog;
use App\DetailTimeLog;
use Auth;
use Carbon\Carbon;
use DB;

class CheckinObserver
{
    public function created(Checkin $checkin)
    {
        if (Auth::check()) {
            DB::beginTransaction();
            try {
                $log= new Log();
                $log->id_staff=Auth::user()->id;
                $log->datetime_log=Carbon::now('Asia/Ho_Chi_Minh');
                $log->action='Checkin';
                $log->save();
                $timelog=new TimeLog();
                $timelog->user_id=Auth::user()->id;
                $timelog->status=0;
                $timelog->check_date=date('Y-m-d');
                $timelog->save();
                $t=TimeLog::where('user_id', Auth::user()->id)
                            ->where('check_date',date('Y-m-d'))
                            ->first();
                //dd($t->id);
                $dtl=new DetailTimeLog();
                $dtl->id_timelog=$t->id;
                $dtl->checkin_time=Carbon::now('Asia/Ho_Chi_Minh');
                $dtl->save();
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                throw new Exception("Error Processing Request", 1);
                
            }
        }
    }
}
