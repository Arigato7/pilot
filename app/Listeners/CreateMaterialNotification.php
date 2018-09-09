<?php

namespace Pilot\Listeners;

use Pilot\Events\MaterialCreated;
use Pilot\Events\NewsCreated;
use Pilot\News;
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

        $news = News::create([
            'user_id' => $event->material->user_id,
            'header' => $user->name . ' добавил материал - ' . $event->material->name,
            'theme' => 'Оповещение',
            'is_notification' => 'true',
            'description' => $event->material->description,
            'content' => ''
        ]);
        
        event(new NewsCreated($news));
    }
}
