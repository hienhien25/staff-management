<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Position;

class DepartmentController extends Controller
{
    public function showlist()
    {
    	$dep=Department::paginate(12);
    	return view('layout.department.department_list',compact('dep'));
    }
    public function getadd()
    {
    	return view('layout.department.addDepartment');
    }
    public function postadd(Request $req)
    {
    	$this->validate($req,
    		[
    			'department_name'=>'required'
    		],
    		[
    			'department_name.required'=>'Bạn chưa nhập tên phòng !'
    		]
    	);
    	$de= new Department;
    	$de->department_name=$req->department_name;
    	$de->quantity=$req->quantity;
    	$de->save();
    	return redirect(route('admin.DepartmentList'));
    }
    public function showlistposition($id)
    {
    	$sp=Position::where('id_department',$id)->paginate(12);
        dd($sp);
    	return view('layout.department.department_list',compact('sp'));
    }
}
