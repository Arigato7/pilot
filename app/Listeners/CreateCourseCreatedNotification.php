<?php

namespace Pilot\Listeners;

use Pilot\Events\CourseCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateCourseCreatedNotification
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
     * @param  CourseCreated  $event
     * @return void
     */
    public function handle(CourseCreated $event)
    {
        //
    }
}
