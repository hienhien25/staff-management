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
        //dd($id);
        $sh=DB::table('tbldepartment')
        ->join('tblposition', 'tbldepartment.id', '=', 'tblposition.id_department')
        ->rightJoin('users', 'tbldepartment.id', '=', 'users.id_department')
        ->where('tblposition.id', $id)
        ->select('tbldepartment.*', 'tblposition.*', 'users.*', 'users.fullname as fullname', 'users.email as email', 'users.role as role')
        ->paginate(12);
        //$staff=DB::table('tbldepartment')
        return view('layout.position.show_list_staff', compact('sh'));
    }
    public function postDelete(Request $req, $id)
    {
        $dp=Position::find($id);
        //dd($dp);
        if (!$dp->delete()) {
            throw new Exception("System Error", 1);
        }
        return redirect()->back();
    }
    public function getAdd()
    {
        $de=Department::all();
        return view('layout.position.add_position', compact('de'));
    }
    public function postAdd(SavePossitionRequest $req)
    {
        $posi=new Position();
        $posi->fill($req->all());
        $posi->id_department=$req->department;
        if (!$posi->save()) {
            throw new Exception("System Error", 1);
        }
        return redirect()->back()->with('msg', 'Bạn đã thêm thành công !');
    }
    public function postEdit(Request $req, $id)
    {
        $pos=Position::find($id);
        $pos->position_name=$req->position_name;
        $pos->description=$req->description;
        if (!$pos->save()) {
            throw new Exception("System Error ", 1);
        }
        return redirect()->back();
    }
    public function getEditPosition($id)
    {
        $position=Position::where('id',$id)->get();
        dd($position);
        return response()->json(['position_name'=>$position->position_name,'description'=>$position->description]);
    }
}
