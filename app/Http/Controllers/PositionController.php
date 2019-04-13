<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;
use App\Department;
use DB;
use App\Http\Requests\SavePossitionRequest;
class PositionController extends Controller
{
    public function showStaffList($id)
    {
    	$sh=DB::table('tbldepartment')
                    ->join('tblposition', 'tbldepartment.id', '=', 'tblposition.id_department')
                    ->rightJoin('users','tbldepartment.id','=','users.id_department')
                    ->where('users.id_department',$id)
                    ->select('tbldepartment.*','tblposition.*','users.*','users.fullname as fullname','users.email as email','users.role as role')
                    ->paginate(12);
        //dd($sh);
        return view('layout.position.show_list_staff',compact('sh'));
    }
    public function getDelete($id)
    {
        $dp=Position::find('id');
        $dp->delete();
        return redirect(route('admin.positionList'));
    }
    public function getAdd()
    {
        $de=Department::all();
        return view('layout.position.add_position',compact('de'));
    }
    public function postAdd(SavePossitionRequest $req)
    {
        $posi=new Position();
        $posi->fill($req->all());
        $posi->id_department=$req->department;
        $posi->save();
        return redirect()->back()->with('msg','Bạn đã thêm thành công !');;
    }
   
}
