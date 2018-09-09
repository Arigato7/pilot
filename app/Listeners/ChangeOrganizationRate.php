<?php

namespace Pilot\Listeners;

use Pilot\Events\OrganizationRated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangeOrganizationRate
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
     * @param  OrganizationRated  $event
     * @return void
     */
    public function handle(OrganizationRated $event)
    {
        //
    }
}
