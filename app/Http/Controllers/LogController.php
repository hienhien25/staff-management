<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Log;
use DB;
use App\Statistics;
use App\TimeLog;
use App\DetailTimeLog;
use Carbon\Carbon;
use App\Checkin;
use App\Time;

class LogController extends Controller
{
    public function getLog()
    {
        $log=Log::where('id_staff', Auth::user()->id)
        ->orderBy('id', 'desc')
        ->paginate(12);
        $count=count($log);
        return view('layout.user.log', compact('log', 'count'));
    }
    public function destroy($id)
    {
        $l=Log::find($id);
        $l->delete();
        return redirect()->back();
    }
    public function deleteMany(Request $req)
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
        $day=date('Y-m-d');
        $tl=TimeLog::where('check_date', $day)->paginate(10);
        //dd($tl);
        return view('timelog', compact('tl'));
    }
    public function getDetailTimeLog($id)
    {
        $dtl=DetailTimeLog::where('id_timelog', $id)->first();
        echo "<tr>
        <td>Checkin : </td>
        <td >
        ".$dtl->checkin_time."
        </td>
        </tr>";
        if (!$dtl->checkout_time==null) {
            echo "
            <tr>
            <td> Checkout : </td>
            <td>
            ".$dtl->checkout_time."
            </td>
            </tr>
            ";
        }
    }
    public function getEditTimeLog($id)
    {
        //dd($id);
        $tlg=DetailTimeLog::where('id_timelog', $id)->first();
        //dd($tlg);
        return response()->json(['checkin_time'=>$tlg->checkin_time,'checkout_time'=>$tlg->checkout_time]);
    }
    public function postEditTimeLog(Request $req)
    {
        DB::beginTransaction();
        try {
            $id=$req->id;
            //dd($id);
            //dd($req->finish);
            $timelog=TimeLog::where('id', $id)->first();
            //dd($timelog);
            $m=Carbon::now()->month;
            $mon=Time::where('month', $m)->first();
            $detailTimeLog=DetailTimeLog::where('id_timelog', $id)->first();
            //dd($detailTimeLog);
            $detailTimeLog->checkin_time=$req->start;
            $detailTimeLog->checkout_time=$req->finish;
            $detailTimeLog->save();
            $chk=DB::table('tblstatistic')
                    ->join('tbltimelog', 'tblstatistic.id_staff', '=', 'tbltimelog.user_id')
                    ->where('tbltimelog.id', $id)
                    ->where('tblstatistic.id_staff',$timelog->user_id)
                    ->where('tbltimelog.check_date', $timelog->check_date)
                    ->select('tblstatistic.*', 'tbltimelog.*','tblstatistic.id as id_stat');
            $chk2 = clone $chk;
            $chk = $chk->first();
            //dd($chk);
            // Lấy ra record trong bảng checkin để thực hiện update
            $checkin=DB::table('tblcheckin')
                    ->join('tblstatistic', 'tblcheckin.id_statist', '=', 'tblstatistic.id')
                    ->where('tblcheckin.check_date', $timelog->check_date)
                    ->where('tblstatistic.id_staff', $timelog->user_id)
                    ->select('tblcheckin.*','tblstatistic.*','tblcheckin.id as id_check');
                    /*->update([
                        'start_hour' => $req->start,
                        'finish_hour' => $req->finish
                    ]);*/
            $checkin2=clone $checkin;
            $checkin=$checkin->first();
            //dd($checkin);
            $check=Checkin::where('id',$checkin->id_check)->first();
            //dd($check);
            $check->start_hour=$req->start;
            $check->finish_hour=$req->finish;
            if(!$check->save())
            {
                throw new Exception("Error Processing Request", 1);
                
            }
            $stat=DB::table('tblcheckin')
                ->join('tblstatistic', 'tblcheckin.id_statist', '=', 'tblstatistic.id')
                ->select(DB::raw(' SUM(TIME_TO_SEC(TIMEDIFF(`finish_hour`, `start_hour`))) as total,id_statist'))
                ->where('tblstatistic.id_month', $mon->id)
                ->where('id_statist', $chk->id_stat)
                ->groupBy('id_statist')
                ->first();//dd($stat);
            $record=DB::table('tblcheckin')
                ->join('tblstatistic', 'tblcheckin.id_statist', '=', 'tblstatistic.id')
                ->where('tblstatistic.id_month', $mon->id)
                ->where('id_statist', $chk->id_stat)
                ->where('tblcheckin.status',1)
                ->count();
            //dd($record);
            //dd($stat->total);
            //dd($record*8*60*60-$stat->total);
            if($record*8*60*60-$stat->total<=0)
            {
                $totalleave=0;
            }else{
                $totalleave=$record*8*60*60-$stat->total;
            }
            $chk2->update([
                'total_working_hour' => $stat->total,
                'total_leave_hour' => $totalleave
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception("Error Processing Request", 1);
        }
     return response()->json(['success'=>true]);
    }
    public function deleteTimeLog(Request $req)
    {
        DB::beginTransaction();
        try {
            $id=$req->id;
            //dd($id);
            $tl=TimeLog::find($id);
            // dd($tl);
            $dtl=DetailTimeLog::where('id_timelog', $id)->first();
            //dd($dtl);
            $timelog=TimeLog::where('id', $id)->first();
            //dd($timelog);
            $m=Carbon::now()->month;
            $mon=Time::where('month', $m)->first();
            // dd($mon);
            $updatetotal=Statistics::where('id_staff', $timelog->user_id)
            ->where('id_month', $mon->id)
            ->first();
            //dd($updatetotal);
            $start=Carbon::create($dtl->checkin_time);
            $finish=Carbon::create($dtl->checkout_time);
            $totalperday=$finish->diffInMinutes($start);
            $updatetotal->total_working_hour-=$totalperday;
            $updatetotal->total_leave_hour+=$totalperday;
            $updatetotal->save();
            $dtl->delete();
            $tl->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception("Error Processing Request");
        }
        return response()->json(['success'=>true]);
    }
}
