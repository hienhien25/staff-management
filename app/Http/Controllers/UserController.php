<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use App\Detail;
use App\Position;

class UserController extends Controller
{
    public function showlist()
    {
    	$user=Staff::paginate(12);
    	return view('layout.user.list_user',compact('user'));
    }
     public function getadd()
    {
        $pos=Position::all();
    	return view('layout.position.add_position',compact('pos'));
    }
    public function postadd(Request $req)
    {
    	 $this->validate($req,
            [
                'name'=>'required|min:2|max:50',
                'email'=>'required|unique|email|min:8|max:255',
                'password'=>'required|min:8|max:30'
            ],
            [
                'name.required'=>'Bạn chưa điền tên !',
                'name.min'=>'Vui lòng nhập tên từ 2 kí tự trở lên!',
                'name.max'=>'Tên dài không quá 50 kí tự!',
                'email.required'=>'Bạn chưa điền email',
                'email.unique'=>'Email này đã tồn tại !'
                'email.email'=>'Email của bạn không hợp lệ !',
                'email.min'=>'Vui lòng nhập email từ 8 kí tự trở lên !',
                'email.max'=>'Email dài không quá 255 kí tự',
                'password.required'=>'Bạn chưa nhập mật khẩu',
                'password.min'=>'Vui lòng nhập mật khẩu từ 8 kí tự trở lên !',
                'password.max'=>'Mật khẩu dài không quá 30 kí tự!'
            ]
        );
    	$st=new Staff;
    	$st->fullname=$req->name;
        $st->email=$req->email;
        $st->password=Hash::make($req->password);
        $st->role=$req->role;
        $st->save();
        $std=new Detail;
        $std->dob=$req->dob;
        if($req->hasFile('image')){
            $file=$req->file('image');
            $name=$file->getClientOriginalName();
            $image=str_random(9).$name;
            $file->move('images',$image);
            $std->image='images/'.$image;
        }
        $std->phone=$req->phone;
        $std->address=$req->address;
        $std->larary=$req->larary;
        $std->save();
        $sp=new Position;
        $sp->position_name=$req->position;
        $sp->save();
        return redirect(route('UserList'))->with('msg','Bạn đã thêm thành công !');
    }
    public function getedit($id)
    {
        $st=Staff::find('id');
        return view('layout.user.editstaff',compact('st'));
    }
    public function postedit(Request $req,$id)
    {
        $this->validate($req,
            [
                'name'=>'required|min:2|max:50',
                'email'=>'required|unique|email|min:8|max:255',
                'password'=>'required|min:8|max:30'
            ],
            [
                'name.required'=>'Bạn chưa điền tên !',
                'name.min'=>'Vui lòng nhập tên từ 2 kí tự trở lên!',
                'name.max'=>'Tên dài không quá 50 kí tự!',
                'email.required'=>'Bạn chưa điền email',
                'email.unique'=>'Email này đã tồn tại !'
                'email.email'=>'Email của bạn không hợp lệ !',
                'email.min'=>'Vui lòng nhập email từ 8 kí tự trở lên !',
                'email.max'=>'Email dài không quá 255 kí tự',
                'password.required'=>'Bạn chưa nhập mật khẩu',
                'password.min'=>'Vui lòng nhập mật khẩu từ 8 kí tự trở lên !',
                'password.max'=>'Mật khẩu dài không quá 30 kí tự!'
            ]
        );
        $st->fullname=$req->name;
        $st->email=$req->email;
        $st->password=Hash::make($req->password);
        $st->role=$req->role;
        $st->save();
        $std->dob=$req->dob;
        if($req->hasFile('image')){
            $file=$req->file('image');
            $name=$file->getClientOriginalName();
            $image=str_random(9).$name;
            $file->move('images',$image);
            $std->image='images/'.$image;
        }
        $std->phone=$req->phone;
        $std->address=$req->address;
        $std->larary=$req->larary;
        $std->save();
        $sp->position_name=$req->position;
        $sp->save();
        return redirect(route('UserList'))->with('msg','Bạn đã thêm thành công !');
    }
}
