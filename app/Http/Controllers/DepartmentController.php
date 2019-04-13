<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Position;
use App\User;
use DB;
use App\Http\Requests\SaveDepartmentRequest;

class DepartmentController extends Controller
{
    public function showList()
    {
    	$dep=Department::paginate(12);
        $sl=DB::table('users')->where('id_department','=',1)->get();
        $qtt=count($sl);
        //dd($qtt);
    	return view('layout.department.department_list',compact('dep'));
    }
    public function getAdd()
    {
    	return view('layout.department.addDepartment');
    }
    public function postAdd(SaveDepartmentRequest $req)
    {
    	$de= new Department();
    	$de->fill($req->all());
    	$de->save();
    	return redirect(route('admin.departmentList'));
    }
    public function showListPosition($id)
    {
     //    $dep=Department::find('id');
    	// $sp=Position::where('id_department',$id)->paginate(12);
        // $count=Position::where('id_department',$id)->count();
        // dd($count);
        //dd($sp);
       $pos=DB::table('tbldepartment')
                    ->leftjoin('tblposition', 'tblposition.id_department', '=', 'tbldepartment.id')
                    ->where('id_department',$id)
                    ->select('tbldepartment.*', 'tblposition.*', 'tbldepartment.department_name as department_name','tblposition.position_name as position_name','tblposition.description as description')
                    ->paginate(12);
    	return view('layout.position.list_position',compact('pos'));
    }
    public function getDelete($id)
    {
        $de=Department::find($id);
        //dd($de);
        $de->delete();
        return redirect(route('admin.departmentList'));
    }
}
