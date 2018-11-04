<?php

namespace Pilot\Listeners;

use Pilot\User;
use Pilot\Material;
use Pilot\UserAction;
use Pilot\MaterialComment;
use Pilot\Events\UserRated;
use Pilot\Events\MaterialRated;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangeMaterialRate
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
     * @param  MaterialRated  $event
     * @return void
     */
    public function handle(MaterialRated $event)
    {
        // Получение всех отзывов к материалу
        $reviews = MaterialComment::where('material_id', $event->material->id);
        // Количество всех отзывов к материалу
        $allPointsCount = $reviews->count();
        // Количество всех положительных отзывов к материалу 
        $positivePointsCount = $reviews->where('review', 'like')->count();
        // Процентного соотношения между положительными отзывами и всеми отзывами
        $ratePercent = ($positivePointsCount * 100) / $allPointsCount;
        // Расчет оценки материала
        $rawRate = (5 * $ratePercent) / 100;
        $rate = round($rawRate, 1);
        // Сохранение оценки материала
        DB::table('materials')
                ->where('id', $event->material->id)
                ->update([
                    'rate' => $rate
                ]);
        // Инициация события "Пользователь оценен"
        event(new UserRated(User::findOrFail($event->material->user_id)));

    }
}
