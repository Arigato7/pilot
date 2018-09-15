<?php

namespace Pilot\Listeners;

use Pilot\Events\CourseSubscribed;
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
     * @param  CourseSubscibed  $event
     * @return void
     */
    public function handle(CourseSubscibed $event)
    {
        //
    }
}
