<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Detail;
use App\Position;
use App\Department;
use Hash;
use DB;
use Mail;
use App\Profile;
use Carbon\Carbon;
use App\Http\Requests\SaveStaffRequest;
use App\PasswordResset;

class UserController extends Controller
{
    public function showList()
    {
        $user=User::paginate(12);
        return view('layout.user.list_user', compact('user'));
    }
    public function getAdd()
    {
        $de=Department::all();
        $pos=Position::all();
        return view('layout.user.add_staff', compact('pos', 'de'));
    }
    public function postAdd(SaveStaffRequest $req)
    {
        DB::beginTransaction();
        try {
            $st=new User();
            $st->fill($req->all());
            $st->id_department=$req->department;
            if ($req->hasFile('image')) {
                $file=$req->file('image');
                $name=$file->getClientOriginalName();
                $image=str_random(9).$name;
                $file->move('images', $image);
                $st->image='images/'.$image;
            }
            $st->password=Hash::make($req->password);
            $st->role=$req->role;
            $st->save();
            $std=new Detail();
            $std->id_staff=$st->id;
            $std->fill($req->all());
            $std->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("System Error", 1);
        }
        return redirect(route('admin.userList'));
    }
    public function getEdit($id)
    {
        $st=User::find($id);
        $de=Department::all();
        $std=Detail::where('id_staff', $id)->first();
        $posi=Position::where('id_department', $st->id_department)->first();
        $pos=Position::all();
        return view('layout.user.edit_staff', compact('st', 'de', 'std', 'posi', 'pos'));
    }
    public function postEdit(Request $req, $id)
    {
        DB::beginTransaction();
        try {
            $st=User::find($id);
            $st->fullname=$req->fullname;
            $st->email=$req->email;
            //$st->fill($req->all());
            $st->id_department=$req->department;
            if ($req->hasFile('image')) {
                $filename = uniqid(). "." . $req->image->extension();
                $path = $req->image->storeAs('images', $filename);
                $st->image = $path;
            }
            $st->password=Hash::make($req->password);
            if (Auth::user()->role==1) {
                $st->role=$req->role;
            }
            $st->save();
            $std=Detail::where('id_staff', $id)->first();
            if ($std) {
                $std->id_staff=$id;
                $std->fill($req->all());
                $std->save();
            } else {
                $dt=new Detail();
                $dt->id_staff=$id;
                $dt->fill($req->all());
                $dt->save();
            }
            
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Error ", 1);
        }
        return redirect(route('admin.userList'))->with('msg', 'Bạn đã thêm thành công !');
    }
    public function getProfile($id)
    {
        $pr=User::find($id);
        $dp=Detail::where('id_staff', $id)->first();
        $depa=Department::where('id', $pr->id_department)->first();
        $pos=Position::where('id_department', $depa->id)->first();
        return view('layout.user.profile', compact('pr', 'dp', 'depa', 'pos'));
    }
    public function getDelete($id)
    {
        $ds=User::find($id);
        //dd($ds);
        if (!$ds->delete()) {
            throw new Exception("Error ", 1);
        }
        return redirect()->back();
    }
    public function getAddMember()
    {
        $de=Department::all();
        return view('layout.add_member', compact('de'));
    }
    public function postAddMember(Request $req)
    {
        $t= new Profile();
        $token=$t->getToken();
        $email=$req->email;
        $created_at=Carbon::now('Asia/Ho_Chi_Minh');
        DB::table('password_resets')->insert(['email'=>$email, 'token'=>$token, 'created_at'=>$created_at]);
        $data=['email'=>$email, 'token'=>$token];
        try {
            Mail::send('send_mail_add_member', $data, function ($msg) use ($data) {
                $msg->from('tienphamnb123@gmail.com', 'Pham Tien');
                $msg->to($data['email']);
                $msg->subject('Thư gửi thành viên mới ');
            });
        } catch (Exception $e) {
            throw new Exception("System Error", 1);
        }
        return redirect(route('home'));
    }
    public function changeUright(Request $req)
    {
        $idrole=$req->idrole;
        $iduser=$req->id;
        //dd($iduser);
        $user=User::where('id', $iduser)->first();
        $user->role=$idrole;
        if (!$user->save()) {
            throw new Exception("Error Processing Request", 1);
        }
    }
    public function postEditProfile(Request $req,$id)
    {
        DB::beginTransaction();
        try {
            $profile=User::where('id', $id)->first();
            //dd($profile);
            $profile->fullname=$req->fullname;
            $profile->email=$req->email;
            $profile->save();
            $detailProfile=Detail::where('id_staff', $id)->first();
            if ($detailProfile) {
                $detailProfile->id_staff=$id;
                $detailProfile->fill($req->all());
                $detailProfile->save();
            }else{
                $detail=new Detail();
                $detail->id_staff=$id;
                $detail->fill($req->all());
                $detail->save();
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception("Error Processing Request", 1);
        }
        return redirect()->back();
    }
}
