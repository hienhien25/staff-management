<?php

namespace App\Observers;

use App\User;
use App\Log;
use Carbon\Carbon;
use Auth;
class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        if ($user->wasRecentlyCreated == true) {
            $action = 'Created User ';
        } else {
            $action = 'Updated User';
        }
        if(Auth::check())
        {
            $log=new Log();
            $log->id_staff=Auth::user()->id;
            $log->action=$action;
            $log->datetime_log=Carbon::now('Asia/Ho_Chi_Minh');
            $log->save();
        }

    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        if(Auth::check())
        {
            $log=new Log();
            $log->id_staff=Auth::user()->id;
            $log->action='Deleted User';
            $log->datetime_log=Carbon::now('Asia/Ho_Chi_Minh');
            $log->save();
        }
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
