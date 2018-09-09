<?php

namespace Pilot\Listeners;

use Pilot\Material;
use Pilot\Events\UserRated;
use Illuminate\Support\Facades\DB;
use Pilot\Events\OrganizationRated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangeUserRate
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
     * @param  UserRated  $event
     * @return void
     */
    public function handle(UserRated $event)
    {
        // Получение всех материалов
        $materials = Material::where('user_id', $event->user->id);
        // Расчет рейтинга пользователя
        $rateAvg = $materials->avg('rate');
        $rate = round($rateAvg, 1);
        // Обновление рейтинга пользователя
        DB::table('user_infos')
                ->where('user_id', $event->user->id)
                ->update([
                    'rate' => $rate
                ]);
    }
}
