<?php

namespace Pilot\Listeners;

use Pilot\Events\MaterialUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateMaterialUpdateNotification
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
     * @param  MaterialUpdated  $event
     * @return void
     */
    public function handle(MaterialUpdated $event)
    {
        //
    }
}
