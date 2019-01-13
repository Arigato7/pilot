<?php

namespace Pilot\Listeners;

use Pilot\Events\CourseUnsubscribed;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Pilot\Mail\CourseUnsubscribed as CourseUnsubscribedMail;

class CourseUnsubscribedNotifyByEmail
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
     * @param  CourseUnsubscribed  $event
     * @return void
     */
    public function handle(CourseUnsubscribed $event)
    {
        Mail::to('plstsale@gmail.com')->send(new CourseUnsubscribedMail($event->courseRecord));
    }
}
