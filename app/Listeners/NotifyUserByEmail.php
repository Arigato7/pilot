<?php

namespace Pilot\Listeners;

use Pilot\UserInfo;
use Pilot\Events\UserCreated;
use Pilot\Mail\UserRegistered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUserByEmail
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
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $email = UserInfo::where('user_id', $event->user->id)->first()->email;
        Mail::to($email)->send(new UserRegistered($event->user, $event->password));
    }
}
