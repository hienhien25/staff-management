<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;

class AjaxController extends Controller
{
    public function getDepartment($iddepartment)
    {
        $pos=Position::where('id_department', $iddepartment)->get();
        foreach ($pos as $p) {
            echo "<option value='". $p->id. "'>". $p->position_name. "</option>";
        }
    }
}
