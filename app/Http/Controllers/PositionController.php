<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;
use App\StaffPosition;
use App\Staff;
use DB;
class PositionController extends Controller
{
    public function showlist()
    {
    	$sl=Position::paginate(12);
    	return view('layout.position.list_position',compact('sl'));
    }
    public function showstafflist($id)
    {
    	$sh=DB::table('tblstaff_position')
                    ->join('tblstaff', 'tblstaff_position.id', '=', 'tblstaff.id_staffpos')
                    ->where('id_position',$id)
                    ->select('tblstaff_position.*', 'tblstaff.*')
                    ->paginate(12);
        return view('layout.position.show_list_staff',compact('sh'));
    }
   
}
