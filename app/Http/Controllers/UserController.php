<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Staff;
use App\Detail;
use App\Position;
use App\Department;
use Hash;
use DB;
class UserController extends Controller
{
    public function showlist()
    {
    	$user=Staff::paginate(12);
    	return view('layout.user.list_user',compact('user'));
    }
     public function getadd()
    {
        $de=Department::all();
        $pos=Position::all();
       /* $pos=DB::table('tbldepartment')
                    ->leftjoin('tblposition', 'tblposition.id_department', '=', 'tbldepartment.id')
                    ->where('id_department',$id)
                    ->select('tbldepartment.*', 'tblposition.*', 'tbldepartment.department_name as department_name','tblposition.position_name as position_name','tblposition.description as description')
                    ->get();*/
    	return view('layout.user.addstaff',compact('pos','de'));
    }
    public function postadd(Request $req)
    {
    	 $this->validate($req,
             [
                'fullname'=>'required|min:2|max:50',
                'email'=>'required|unique|email|min:8|max:255',
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
                'email.unique'=>'Email này đã tồn tại !',
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
    	$st=new Staff;
    	$st->fullname=$req->fullname;
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
        $std->gender=$req->gender;
        $std->save();
        $sp=new Position;
        $sp->position_name=$req->position;
        $sp->save();
        return redirect(route('UserList'))->with('msg','Bạn đã thêm thành công !');
    }
    public function getedit($id)
    {
        $st=Staff::find('id');
        $de=Department::all();
        //dd($de);
        $std=Detail::where('id_staff',$id)->get();
        return view('layout.user.editstaff',compact('st','de','std'));
    }
    public function postedit(Request $req,$id)
    {
        $st=Staff::find('id');
        $std=Detail::where('id_staff','=','id')->get();

        $this->validate($req,
            [
                'fullname'=>'required|min:2|max:50',
                'email'=>'required|unique|email|min:8|max:255',
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
                'email.unique'=>'Email này đã tồn tại !',
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
        return redirect(route('admin.UserList'))->with('msg','Bạn đã thêm thành công !');
    }
    public function getprofile($id)
    {
        $pr=Staff::find('id');
        $pro=Detail::where('id_staff','=','id')->get();
        return view('layout.user.profile',compact('pr','pro'));
    }
    public function getdelete($id)
    {
        $ds=Staff::find('id');
        $ds->delete();
        return redirect(route('admin.UserList'));
    }
}
