<?php

namespace Pilot\Listeners;

use Pilot\News;
use Pilot\UserAction;
use Pilot\Events\MaterialCreated;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateMaterialNotification
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
     * @param  MaterialCreated  $event
     * @return void
     */
    public function handle(MaterialCreated $event)
    {
        $user = DB::table('user_infos')
                            ->select('name')
                            ->where('user_id', $event->material->user_id)
                            ->first();

        $userAction = UserAction::create([
            'user_id' => $event->material->user_id,
            'description' => $user->name . ' добавил материал - ' . $event->material->name,
        ]);
        
    }
}
