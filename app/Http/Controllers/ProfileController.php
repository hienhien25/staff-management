<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;
use App\Department;
use Auth;
class ProfileController extends Controller
{
    public function getupdate($token)
    {
        $tk=$token;
        //dd($token);
    	$de=Department::all();
    	$pos=Position::all();
    	return view('layout.update_profile',compact('de','pos','tk'));
    }
    public function postupdate(Request $req)
    {
    	$idlog=Auth::user()->id;
    	$st=User::find($idlog);
        $this->validate($req,
            [
                'fullname'=>'required|min:2|max:50',
                'email'=>'required|email|min:8|max:255',
                'password'=>'required|min:8|max:30',
                'phone'=>'required|min:8|max:12',
                'address'=>'required',
                'larary'=>'required|number',
                'dob'=>'required'
            ],
            [
                'fullname.required'=>'Bạn chưa điền tên !',
                'fullname.min'=>'Vui lòng nhập tên từ 2 kí tự trở lên!',
                'fullname.max'=>'Tên dài không quá 50 kí tự!',
                'email.required'=>'Bạn chưa điền email !',
                'email.email'=>'Email của bạn không hợp lệ !',
                'email.min'=>'Vui lòng nhập email từ 8 kí tự trở lên !',
                'email.max'=>'Email dài không quá 255 kí tự',
                'password.required'=>'Bạn chưa nhập mật khẩu',
                'password.min'=>'Vui lòng nhập mật khẩu từ 8 kí tự trở lên !',
                'password.max'=>'Mật khẩu dài không quá 30 kí tự!',
                'phone.required'=>'Bạn chưa nhập SĐT !',
                'phone.min'=>'Vui lòng nhập mật khẩu từ 8 kí tự trở lên !',
                'phone.max'=>'Mật khẩu dài không quá 12 kí tự!',
                'address.required'=>'Bạn chưa nhập địa chỉ !',
                'larary.required'=>'Bạn chưa nhập lương !',
                'larary.number'=>'Vui lòng điền số !',
                'dob.required'=>'Bạn chưa điền ngày sinh !'

            ]
        );
        if($req->hasFile('image')){
            $file=$req->file('image');
            $name=$file->getClientOriginalName();
            $image=str_random(9).$name;
            $file->move('images',$image);
            $st->image='images/'.$image;
        }
        $st->fullname=$req->name;
        $st->id_department=$req->department;
        $st->email=$req->email;
        $st->password=Hash::make($req->password);
        $st->role=$req->role;
        $st->save();
        $std=new Detail;
        $std->dob=$req->dob;
        $std->phone=$req->phone;
        $std->address=$req->address;
        $std->larary=$req->larary;
        $std->save();
        return redirect(route('home'))->with('msg','Bạn đã thêm thành công !');
    }
}
