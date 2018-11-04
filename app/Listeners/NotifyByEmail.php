<?php

namespace Pilot\Listeners;

use Pilot\Mail\CourseSubscribed as CourseSubscribedMail;
use Pilot\Events\CourseSubscribed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
        /* Mail::raw('Работает!!!', function ($message) {
            $message->from('downonrabota@mail.ru', 'Laravel');
            $message->to('plstsale@gmail.com');
        }); */
    }
}
