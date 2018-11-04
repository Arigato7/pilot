<?php

namespace Pilot\Listeners;

use Pilot\Events\MaterialDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateMaterialDeleteNotification
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
     * @param  MaterialDeleted  $event
     * @return void
     */
    public function handle(MaterialDeleted $event)
    {
        //
    }
}
