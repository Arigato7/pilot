<?php

namespace Pilot\Listeners;

use Pilot\UserAction;
use Pilot\Events\CourseSubscribed;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateCourseSubscribedNotification
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
        $user = DB::table('user_infos')
                            ->select('name')
                            ->where('user_id', $event->courseRecord->user_id)
                            ->first();
        $course = DB::table('courses')
                            ->select('name')
                            ->where('id', $event->courseRecord->course_id)
                            ->first();

        $userAction = UserAction::create([
            'user_id' => $event->courseRecord->user_id,
            'description' => $user->name . ' записался на курс - ' . $course->name,
        ]);
    }
}
