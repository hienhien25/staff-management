<?php

namespace App\Observers;

use Auth;
use App\Statistics;
use App\Log;
use App\TimeLog;
use App\DetailTimeLog;
use App\Checkout;
use Carbon\Carbon;

class CheckoutObserver
{
    public function created(Checkout $checkout)
    {
        if (Auth::check()) {
            $log=new Log();
            $log->id_staff=Auth::user()->id;
            $log->datetime_log=Carbon::now('Asia/Ho_Chi_Minh');
            $log->action='Checkout';
            $log->save();
            $t=TimeLog::where('user_id', Auth::user()->id)
                        ->where('checkdate', date('Y-m-d'))
                        ->first();
            //dd($t);
            $timelog->status=1;
            $timelog->save();
            $dtl=DetailTimeLog::where('id_timelog', $t->id)->first();
            $dtl->checkout_time=Carbon::now('Asia/Ho_Chi_Minh');
            $dtl->save();
        }
    }
}
