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
     return response()->json(['message'=>'Chung toi da gui email cho ban de khoi phuc tai khoan . Vui long kiem tra lai email !']);
 }
 public function getReset($token)
 {
    $pr=PasswordResset::where('token',$token)->first();
    //dd($pr);
    if(!$pr){
        return response()->json([
            'message'=>'Token da het han thuc hien !'
        ]);
    }
    if(Carbon::parse($pr->update_at)->addMinutes(120)->isPast()){
        $pr->delete();
        return response()->json([
            'message'=>'Token da het han thuc hien  !'
        ]);

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
public function getConfirm()
{
    return view('layout.confirm_email');
}
public function postConfirm(Request $req)
{
    $pr=PasswordResset::where('token',$req->token)->first();
    //dd($pr);
    $user=User::where('email',$pr->email)->first();
    $active=UserActive::where('user_id',$user->id)->first();
    if($active->activation_code ==$req->code)
    {
        $user->active=1;
        $user->save();
        $pr=PasswordResset::where('email',$req->email)->first();
        $pr->delete();
        $active->delete();
        return redirect(route('adminLogin'));
    }else{
        return redirect(route('confirmEmail '))->with('msg','Nhập sai mã xác minh !');
    }

}
}
