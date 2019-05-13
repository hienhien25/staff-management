<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Log;
use DB;
class LogController extends Controller
{
	public function getLog()
	{
		$log=Log::where('id_staff',Auth::user()->id)
		->orderBy('id','desc')
		->paginate(12);
    	//dd($log);
		$count=count($log);
    	//dd($count);
		return view('layout.user.log',compact('log','count'));
	}
	public function destroy($id)
	{
		$l=Log::find($id);
		$l->delete();
		return redirect()->back();
	}
	public function DeleteMany(Request $req)
	{
		$ids = $req->code;
        $del = DB::table("tbllog")->whereIn('id', $ids)->delete();
        if ($del) {
        	return response()->json([
				'success' => true
			]);
        }
     	return response()->json([
			'success' => false
		]);
	}
}
