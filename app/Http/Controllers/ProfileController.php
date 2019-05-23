<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;
use App\Department;
use Auth;
use App\Http\Requests\SaveStaffRequest;
use App\User;
use App\PasswordResset;
use Carbon\Carbon;
use Hash;
use App\Detail;
use App\Profile;
use Mail;
use App\UserActive;
use DB;
use Exception;

class ProfileController extends Controller
{
    public function getUpdate($token)
    {
        $pr=PasswordResset::where('token', $token)->first();
        //dd($pr);
        if (!$pr) {
            return redirect(route('expiration'));
        }
        if (Carbon::parse($pr->created_at)->addMinutes(120)->isPast()) {
            $pr->delete();
            return redirect(route('expiration'));
        }
        $de=Department::all();
        $pos=Position::all();
        return view('layout.update_profile', compact('de', 'pos'));
    }
    public function postUpdate(SaveStaffRequest $req)
    {
        $st=new User();
        $st->fill($req->all());
        $st->id_department=$req->department;
        if ($req->hasFile('image')) {
            $file=$req->file('image');
            $name=$file->getClientOriginalName();
            $image=str_random(15).$name;
            $file->move('images', $image);
            $st->image='images/'.$image;
        }
        $st->password=Hash::make($req->password);
        $st->role=$req->role;
        $st->save();
        $std=new Detail();
        $std->fill($req->all());
        $std->id_staff=$st->id;
        $std->save();
        $code=rand(100000, 10000000000);
        $tk=new PasswordResset();
        $token=$tk->getToken();
        $data=['email'=>$req->email,'token'=>$token];
        try {
            Mail::send('confirm_email_of_user', $data, function ($msg) use ($data) {
                $msg->from('tienphamnb123@gmail.com', 'Pham Tien');
                $msg->to($data['email']);
                $msg->subject('Email Authentication');
            });
        } catch (Exception $e) {
            throw new Exception("System Error", 1);
        }
        DB::beginTransaction();
        try {
            $user=User::where('email', $req->email)->first();
            $active= new UserActive();
            $active->user_id=$user->id;
            $active->activation_code=$code;
            $active->token=$token;
            $active->save();
            $pr=PasswordResset::where('email', $req->email)->first();
            $pr->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("System Error", 1);
        }
       
        return redirect(route('activeSuscess'))->with('message', 'Vui lòng kiểm tra lại email để hoàn tất việc đăng kí!');
    }
    public function postUpdateInformation(Request $req)
    {
        $user=User::where('id',Auth::user()->id)->first();
        $user->fill(['email'=>$req->email]);
        $user->save();
        $detail=Detail::where('id_staff',Auth::user()->id)->first();
        $detail->fill(['phone'=>$req->phone]);
        $detail->save();
        return redirect()->back();
    }
}
