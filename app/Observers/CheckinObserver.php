<?php

namespace App\Observers;
use App\Checkin;
use App\Log;
use Auth;
class CheckinObserver
{
    public function created(Checkin $checkin)
    {
    	if(Auth::check())
    	{
    		$log= new Log();
    		$log->id_staff=Auth::user()->id;
    		$log->datetime_log=\Carbon\Carbon::now('Asia/Ho_Chi_Minh');
    		$log->action='Checkin';
    		$log->save();
    	}
    }
}
