<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Log;
class LogController extends Controller
{
    public function getLog()
    {
    	$log=Log::where('id_staff',Auth::user()->id)->paginate(8);
    	//dd($log);
    	$count=count($log);
    	//dd($count);
    	return view('layout.user.log',compact('log','count'));
    }
}
