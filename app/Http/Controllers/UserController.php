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
    	return view('layout.user.list_user',compact('user'));
    }
    public function getAdd()
    {
        $de=Department::all();
        $pos=Position::all();
        return view('layout.user.add_staff',compact('pos','de'));
    }
    public function postAdd(SaveStaffRequest $req)
    {
       $st=new User();
       $st->fill($req->all());
       $st->id_department=$req->department;
       if($req->hasFile('image')){
           $file=$req->file('image');
           $name=$file->getClientOriginalName();
           $image=str_random(9).$name;
           $file->move('images',$image);
           $st->image='images/'.$image;
       }
       $st->password=Hash::make($req->password);
       $st->role=$req->role;
       $st->save();
       $std=new Detail();
       $std->id_staff=$st->id;
       $std->fill($req->all());
       $std->save();
       return redirect(route('admin.userList'));
   }
   public function getEdit($id)
   {
    $st=User::find($id);
    $de=Department::all();
    $std=Detail::where('id_staff',$id)->get();
    return view('layout.user.edit_staff',compact('st','de','std'));
}
public function postEdit(SaveStaffRequest $req,$id)
{
    $st=User::find($id);
    $st->fill($req->all());
    $st->id_department=$req->department;
    if($req->hasFile('image')){
        $filename = uniqid(). "." . $req->image->extension();
        $path = $req->image->storeAs('images', $filename);
        $st->image = $path;
    }
    $st->password=Hash::make($req->password);
    $st->role=$req->role;
    $st->save();
    $std=Detail::where('id_staff',$id)->get();
    $std->fill($req->all());
    $std->id_staff=$id;
    $std->save();
    return redirect(route('admin.userList'))->with('msg','Bạn đã thêm thành công !');
}
public function getProfile($id)
{
    $pr=User::find($id);
    //dd($pr);
    $dp=Detail::where('id_staff',$id)->get();
    //dd($dp);
    return view('layout.user.profile',compact('pr','dp'));
}
public function getDelete($id)
{
    $ds=User::find($id);
    $ds->delete();
    return redirect(route('admin.userList'));
}
public function getAddMember()
{
    $de=Department::all();
    return view('layout.add_member',compact('de'));
}
public function postAddMember(Request $req)
{
    $t= new Profile();
    $token=$t->getToken();
    $email=$req->email;
    $created_at=Carbon::now('Asia/Ho_Chi_Minh');
    DB::table('password_resets')->insert(['email'=>$email,'token'=>$token,'created_at'=>$created_at]);
    $data=['email'=>$req->email,'token'=>$token];
    Mail::send('send_mail_add_member',$data, function($msg) use ($data){
        $msg->from('tienphamnb123@gmail.com','Pham Tien');
        $msg->to($data['email']);
        $msg->subject('Thư gửi thành viên mới ');
    });
    return redirect(route('home'));
}
}
