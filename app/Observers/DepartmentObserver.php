<?php

namespace App\Observers;

use App\Department;
use Auth;
use App\Log;

class DepartmentObserver
{
    public function created(Department $department)
    {
        if ($department->wasRecentlyCreated==true) {
            $action='Create Department';
        } else {
            $action='Update Department';
        }
        if (Auth::check()) {
            $log= new Log();
            $log->id_staff=Auth::user()->id;
            $log->datetime_log=\Carbon\Carbon::now('Asia/Ho_Chi_Minh');
            $log->action=$action;
            $log->save();
        }
    }
    public function deleted(Department $department)
    {
        if (Auth::check()) {
            $log= new Log();
            $log->id_staff=Auth::user()->id;
            $log->datetime_log=\Carbon\Carbon::now('Asia/Ho_Chi_Minh');
            $log->action='Deleted Department';
            $log->save();
        }
    }
}
