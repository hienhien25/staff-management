<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\User;
use Mail;
use Carbon\Carbon;
use App\PasswordResset;
use Hash;
use App\UserActive;
use Auth;
use DB;
class PasswordController extends Controller
{
    public function getForgot()
    {
        return view('auth.passwords.email');
    }
    public function create(Request $req)
    {
        $user=User::where('email',$req->email)->first();
        //dd($user);
        $tk= new PasswordResset();
        $token=$tk->getToken();
        if(!$user){
            return response()->json(['message'=>'Khong tim thay tai khoan co email nay !']);
        }
        $pr=PasswordResset::updateOrCreate(
            [
                'email'=>$user->email
            ],
            [
                'email'=>$user->email,
                'token'=>$token
            ]
        );
        if ($user && $pr){
         $user->notify(new PasswordResetRequest($pr->token));
     }
     return redirect(route('activeSuscess'));
 }
 public function getReset($token)
 {
    $pr=PasswordResset::where('token',$token)->first();
    //dd($pr);
    if(!$pr){
        return redirect(route('expiration'));
    }
    if(Carbon::parse($pr->update_at)->addMinutes(120)->isPast()){
        $pr->delete();
        return redirect(route('expiration'));
    }
    return view('auth.passwords.reset',compact('pr'));
}
public function postResset(Request $req)
{
    $pr=PasswordResset::where('email',$req->email)->first();
    //dd($pr);
    if(!$pr){
        return response()->json([
            'message'=>'Ban khong co tai khoan trong he thong !'
        ]);
    }
    $user=User::where('email',$pr->email)->first();
    if(!$user){
        return response()->json([
            'message'=>'Khong tim thay tai khoan co email nay  !'
        ]);
    }
    $user->password=Hash::make($req->password);
    $user->save();
    $pr->delete();
    $user->notify(new PasswordResetSuccess($pr));
    return redirect(route('adminLogin'));
}
public function getSuscess()
{
    return view('layout.active_suscess');
}
public function getConfirm($token)
{
    $check=UserActive::where('token',$token)->first();
    if(!isset($check))
    {
        return redirect(route('expiration'));
    }
    if(Carbon::parse($check->update_at)->addMinutes(120)->isPast())
    {
        $check->delete();
       return redirect(route('expiration'));
    }
    return view('layout.confirm_email');
}
public function postConfirm(Request $req)
{
    $code=rand(100000,10000000000);
    $tk=new UserActive();
    $token=$tk->getToken();
    $data=['email'=>$req->email,'token'=>$token];
    //dd($data);
    try {
        Mail::send('confirm_email_of_user',$data, function($msg) use ($data){
        $msg->from('tienphamnb123@gmail.com','Pham Tien');
        $msg->to($data['email']);
        $msg->subject('Email Authentication');
        });
        
    } catch (Exception $e) {
        return response()->json(['message'=>'Error !']);
    }
    $user=User::where('email',$req->email)->first();
    $active= new UserActive();
    $active->user_id=$user->id;
    $active->activation_code=$code;
    $active->token=$token;
    if(!$active->save())
    {
        throw new Exception("System Error", 1);
        
    }
    return redirect(route('activeSuscess'));
}
public function getActive()
{
    return view('layout.active');
}
public function getMailToActive()
{

    return view('layout.confirm_email');
}
public function verification(Request $req,$token)
{
    $active=UserActive::where('token',$token)->first();
    //dd($active);
   $user=User::where('id',$active->user_id)->first();
   //dd($user);
   $user->active=1;
   DB::beginTransaction();
   try {
      $user->save();
      $active->delete(); 
      DB::commit();
   } catch (Exception $e) {
        DB::rollBack();
       throw new Exception("Lỗi tài khoản chưa được kích hoạt !", 1);
   }
   
   return redirect(route('home'));
}
public function getExpire()
{
    return view('expiration');
}
}
