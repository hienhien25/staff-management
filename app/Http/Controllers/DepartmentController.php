<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Position;
use App\User;
use DB;
use App\Http\Requests\SaveDepartmentRequest;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Writer_Excel2007;
use PHPExcel_Settings;
use App\Log;
use Auth;
use Carbon\Carbon;
use Session;
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
    	return view('layout.department.add_department');
    }
    public function postAdd(SaveDepartmentRequest $req)
    {
    	$de= new Department();
    	$de->fill($req->all());
    	if(!$de->save())
        {
            throw new Exception("System Error", 1);
        }
        return redirect(route('admin.departmentList'));
    }
    public function showListPosition($id)
    {
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
    if(!$de->delete())
    {
        throw new Exception("System Error", 1);
        
    }
    Session::put('success', 'Your Record Deleted Successfully.');
    return redirect(route('admin.departmentList'));
}
public function postEdit(Request $req,$id)
{
    $de=Department::find($id);
    $de->department_name=$req->department_name;
    if(!$de->save())
    {
        throw new Exception("System Error", 1);
    }
    return redirect(route('admin.departmentList'));
}
public function export()
{
    $excel=new PHPExcel();
    $depa=Department::all();
   //dd($depa);
    $excel->setActiveSheetIndex(0);
    $sheet=$excel->getActiveSheet()->setTitle('Department List');
    //dd($sheet);
    $rowCount=1;
    $sheet->setCellValue('A'.$rowCount,'No');
    $sheet->setCellValue('B'.$rowCount,'Department');
    $sheet->setCellValue('C'.$rowCount,'Quantity');

    foreach($depa as $d)
    {
        $rowCount++;
        $sheet->setCellValue('A'.$rowCount,$rowCount-1);
        $sheet->setCellValue('B'.$rowCount,$d->department_name);
        $sheet->setCellValue('C'.$rowCount,$d->quantity);
    }
    $filename='result.xlsx';
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
