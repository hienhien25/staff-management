<?php

namespace App\Observers;
use Auth;
use App\Statistics;
use App\Log;
class CheckoutObserver
{
    public function created(Statistics $stat)
    {
    	if(Auth::check())
    	{
    		$log=new Log();
    		$log->id_staff=Auth::user()->id;
    		$log->datetime_log=\Carbon\Carbon::now('Asia/Ho_Chi_Minh');
    		$log->action='Checkout';
    		$log->save();
    	}
    }
}
