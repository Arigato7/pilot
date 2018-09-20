<?php

namespace Pilot\Listeners;

use Pilot\User;
use Pilot\UserInfo;
use Pilot\Events\CourseSubscribed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyByEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CourseSubscribed  $event
     * @return void
     */
    public function handle(CourseSubscribed $event)
    {
        $userData = DB::table('user_infos')
                            ->select('education_organization_id', 'position_id', 'name', 'lastname', 'middlename')
                            ->where('user_id', $event->courseRecord->user_id)
                            ->get();
        $organization = DB::table('education_organizations')
                            ->select('name')
                            ->where('id', $userData->education_organization_id)
                            ->get();
        $FIO = $userData->lastname . ' ' . $userData->name . ' ' . $userData->middlename;
        $position = DB::table('positions')
                            ->select('name')
                            ->where('id', $userData->position_id)
                            ->get();
    }
}
