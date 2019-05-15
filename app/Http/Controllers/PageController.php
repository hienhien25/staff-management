<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Detail;
use App\Log;
use Carbon\Carbon;
use App\Time;
class PageController extends Controller
{
    public function index()
    {
    	return view('layout.home');
    }
    public function getLogin()
    {
    	return view('layout.login');
    }
    public function postLogin(Request $req){
        $remember = $req->has('remember');
        if(Auth::attempt(['email' => $req->email, 'password' => $req->password], $remember)){
            if(Auth::user()->active==0)
            {
                return redirect(route('active'));
            }
            $time=new Time();
            $time->increasingMonth();
            $log=new Log();
            $log->datetime_log=Carbon::now('Asia/Ho_Chi_Minh');
            $log->action='Login';
            $log->id_staff=Auth::user()->id;
            $log->save();
            return redirect(route('home'));
        }else{
            return view('layout.login')->with('err', 'Sai tài khoản/mật khẩu');
        }
    }
    public function logout()
    {
     Auth::logout();
     return redirect(route('adminLogin'));
 }
}
