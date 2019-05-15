<?php

namespace App\Observers;
use App\Checkin;
use App\Log;
use App\TimeLog;
use App\DetailTimeLog;
use Auth;
use Carbon\Carbon;
class CheckinObserver
{
    public function created(Checkin $checkin)
    {
    	if(Auth::check())
    	{
    		$log= new Log();
    		$log->id_staff=Auth::user()->id;
    		$log->datetime_log=Carbon::now('Asia/Ho_Chi_Minh');
    		$log->action='Checkin';
    		$log->save();
            $timelog=new TimeLog();
            $timelog->user_id=Auth::user()->id;
            $timelog->status=0;
            $timelog->checkdate=date('Y-m-d');
            $timelog->save();
            $t=TimeLog::where('user_id',Auth::user()->id)->first();
            $dtl=new DetailTimeLog();
            $dtl->id_timelog=$t->id;
            $dtl->checkin_time=Carbon::now('Asia/Ho_Chi_Minh');
            $dtl->save();
    	}
    }
}
