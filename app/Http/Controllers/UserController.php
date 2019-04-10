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
class UserController extends Controller
{
    public function showlist()
    {
    	$user=User::paginate(12);
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
    	$st=new User;
        $st->id_department=$req->department;
        if($req->hasFile('image')){
            $file=$req->file('image');
            $name=$file->getClientOriginalName();
            $image=str_random(9).$name;
            $file->move('images',$image);
            $st->image='images/'.$image;
        }
    	$st->fullname=$req->fullname;
        $st->email=$req->email;
        $st->password=Hash::make($req->password);
        $st->role=$req->role;
        $st->save();
        $std=new Detail;
        $std->dob=$req->dob;
        $std->phone=$req->phone;
        $std->address=$req->address;
        $std->larary=$req->larary;
        $std->gender=$req->gender;
        $std->save();
        return redirect(route('admin.UserList'));
    }
    public function getedit($id)
    {
        $st=User::find('id');
        $de=Department::all();
        $std=Detail::where('id_staff',$id)->get();
        return view('layout.user.editstaff',compact('st','de','std'));
    }
    public function postedit(Request $req,$id)
    {
        $st=User::find('id');
        $std=Detail::where('id_staff','=','id')->get();

        $this->validate($req,
            [
                'fullname'=>'required|min:2|max:50',
                'email'=>'required|unique:email|email|min:8|max:255',
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
        if($req->hasFile('image')){
            $file=$req->file('image');
            $name=$file->getClientOriginalName();
            $image=str_random(9).$name;
            $file->move('images',$image);
            $st->image='images/'.$image;
        }
        $st->fullname=$req->name;
        $st->email=$req->email;
        $st->password=Hash::make($req->password);
        $st->role=$req->role;
        $st->save();
        $std->dob=$req->dob;
        $std->phone=$req->phone;
        $std->address=$req->address;
        $std->larary=$req->larary;
        $std->save();
        return redirect(route('admin.UserList'))->with('msg','Bạn đã thêm thành công !');
    }
    public function getprofile($id)
    {
        $pr=User::find('id');
        $pro=Detail::where('id_staff','=','id')->get();
        return view('layout.user.profile',compact('pr','pro'));
    }
    public function getdelete($id)
    {
        $ds=User::find('id');
        $ds->delete();
        return redirect(route('admin.UserList'));
    }
    public function getaddmember()
    {
        $de=Department::all();
        return view('layout.addmember',compact('de'));
    }
    public function postaddmember(Request $req)
    {
        $this->validate($req,
            [
                'fullname'=>'required',
                'email'=>'required|email'
            ],
            [
                'fullname.required'=>'Bạn chưa điền tên !',
                'email.required'=>'Bạn chưa điền email !',
                'email.email'=>'Email không hợp lệ !'
            ]
        );
        $pass=rand(100000,1000000);
        $mem=new User;
        $mem->id_department=$req->department;
        $mem->fullname=$req->fullname;
        $mem->email=$req->email;
        $mem->password=Hash::make($pass);
        $mem->role=$req->role;
        $mem->save();
        $data=['fullname'=>$req->fullname,'email'=>$req->email,'password'=>$pass];
        Mail::send('send_mail_add_member',$data, function($msg) use ($data){
            $msg->from('tienphamnb123@gmail.com','Pham Tien');
            $msg->to($data['email']);
            $msg->subject('Thư gửi thành viên mới ');
        });
        return redirect(route('home'));
    }
}
