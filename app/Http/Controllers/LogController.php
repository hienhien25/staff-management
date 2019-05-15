<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Log;
use DB;
use App\Statistics;
use App\TimeLog;
use App\DetailTimeLog;
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
	public function getTimeLog()
	{
		$tl=DB::table('tbltimelog')
		->join('users','tbltimelog.user_id','=','users.id')
		->select('tbltimelog.*','users.*','users.fullname as username','tbltimelog.status as status','tbltimelog.check_date as check_date')
		->paginate(10);
		return view('timelog',compact('tl'));
	}
	public function deleteTimeLog(Request $req)
	{
		DB::beginTransaction();
		try {
			$id=$req->id;
			//dd($id);
			$dtl=DetailTimeLog::where('id_timelog',$id)->first();
			$dtl->delete();
			$tl=TimeLog::find($id);
			$tl->delete();
			$timelog=TimeLog::where('id',$id)->first();
			$m=$timelog->check_date;
			$mon=$m['mon'];
			//dd($m);
			$updatetotal=Statistics::where('id_staff',$timelog->user_id)
			->where('month',$mon)
			->first();
			$start=Carbon::create($dtl->checkin_time);
			$finish=Carbon::create($dtl->checkout_time);
			$totalperday=$finish->diffInMinutes($start);
			$updatetotal->total_working_hour-=$totalperday;
			$updatetotal->total_leave_hour+=$totalperday;
			$updatetotal->save();
			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
			throw new Exception("Error Processing Request", 1);	
		}
		
		return response()->json(['success'=>true]);
	}
}
