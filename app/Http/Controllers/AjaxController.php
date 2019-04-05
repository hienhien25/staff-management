<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;

class AjaxController extends Controller
{
    public function getdepartment($iddepartment)
    {
    	$pos=Position::where('id_department',$iddepartment)->get();
    	//dd($pos);
    	foreach($pos as $p)
    	{
    		echo "<option value='".$p->id."'>".$p->position_name."</option>";
    	}
    }
}
