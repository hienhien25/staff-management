<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Statistics;
use App\User;
use DB;
use App\Checkin;
use Auth;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Writer_Excel2007;
use PHPExcel_Settings;
class StatisticController extends Controller
{
    public function getShowListPerMonth()
    {
    	$m=Carbon::now()->month;
    	$month=DB::table('tblstatistic')
       ->join('tbltime','tblstatistic.id_month','=','tbltime.id')
       ->rightjoin('users','tblstatistic.id_staff','=','users.id')
       ->where('tbltime.month',$m)
       ->select('tblstatistic.*','tbltime.*','users.*','tbltime.month as month','tblstatistic.id_staff as id_staff','tblstatistic.total_working_hour as total_working_hour','users.fullname as fullname')
       ->paginate(12);
    	//dd($month);
       $mon=\App\Time::all();
       return view('layout.user.list_checkout_per_month',compact('month','mon'));
   }
   public function getSearch(Request $req)
   {
     $user=DB::table('tblcheckin')
     ->join('tblstatistic','tblcheckin.id_statist','=','tblstatistic.id')
     ->leftjoin('users','tblstatistic.id_staff','=','users.id')
     ->where('tblcheckin.check_date',$req->keyword)
     ->select('users.*','tblcheckin.*','tblstatistic.*','tblcheckin.start_hour as start_hour','tblcheckin.finish_hour as finish_hour','tblcheckin.check_date as check_date','users.fullname as fullname','tblcheckin.status as status')
     ->paginate(12);   
		        //dd($user);
     $month=\App\Time::all();  
     return view('layout.user.list_checkout_per_day',compact('user','month'));
 }
 public function getPersonal()
 {
    $statist=DB::table('tblstatistic')
    ->join('tbltime','tblstatistic.id_month','=','tbltime.id')
    ->where('tblstatistic.id_staff',Auth::user()->id)
    ->select('tblstatistic.*','tbltime.*','tblstatistic.total_working_hour as total_working_hour','tblstatistic.total_leave_hour as total_leave_hour','tbltime.month as month')
    ->paginate(12);
        //dd($statist);
    return view('layout.user.statistic_personal_list',compact('statist'));
}
public function getExport(Request $req)
{
    $excel=new PHPExcel();
    $stat=DB::table('tblstatistic')
        ->join('tbltime','tblstatistic.id_month','=','tbltime.id')
        ->rightjoin('users','tblstatistic.id_staff','=','users.id')
        ->where('tbltime.month',$req->month)
        ->select('tblstatistic.*','tbltime.*','users.*','tbltime.month as month','tblstatistic.id_staff as id_staff','tblstatistic.total_working_hour as total_working_hour','users.fullname as fullname','tblstatistic.total_leave_hour as total_leave_hour')
        ->get();
    //dd($stat);
    $excel->setActiveSheetIndex(0);
    $sheet=$excel->getActiveSheet()->setTitle('Statistics List');
    $rowCount=1;
    $sheet->setCellValue('A'.$rowCount,'No');
    $sheet->setCellValue('B'.$rowCount,'Month');
    $sheet->setCellValue('C'.$rowCount,'Username');
    $sheet->setCellValue('D'.$rowCount,'Total working hours');
    $sheet->setCellValue('E'.$rowCount,'Total leave hours');

    foreach($stat as $t)
    {
        $rowCount++;
        $sheet->setCellValue('A'.$rowCount,$rowCount-1);
        $sheet->setCellValue('B'.$rowCount,$t->month);
        $sheet->setCellValue('C'.$rowCount,$t->fullname);
        $sheet->setCellValue('D'.$rowCount,$t->total_working_hour);
        $sheet->setCellValue('E'.$rowCount,$t->total_leave_hour);
    }
    $filename='statistics.xlsx';
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header('Content-Disposition:inline;filename="' . $filename . '"');
    header("Content-Transfer-Encoding: binary");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Pragma: no-cache");
    $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $objWriter->save('php://output');
    exit;
}
}
