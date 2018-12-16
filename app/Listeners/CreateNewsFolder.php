<?php

namespace Pilot\Listeners;

use Pilot\Events\NewsCreated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateNewsFolder
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
     * @param  NewsCreated  $event
     * @return void
     */
    public function handle(NewsCreated $event)
    {
        $directory = "/public/news";
        if (! Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }
    }
}
