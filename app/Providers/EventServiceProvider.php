<?php

namespace Pilot\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Pilot\Events\UserCreated' => [
            'Pilot\Listeners\CreateUserFolder',
        ],
        'Pilot\Events\NewsCreated' => [
            'Pilot\Listeners\CreateNewsFolder',
            'Pilot\Listeners\CreateNewsNotification'
        ],
        'Pilot\Events\MaterialCreated' => [
            'Pilot\Listeners\CreateMaterialNotification',
        ],
        'Pilot\Events\MaterialUpdated' => [
            'Pilot\Listeners\CreateMaterialUpdateNotification',
        ],
        'Pilot\Events\MaterialDeleted' => [
            'Pilot\Listeners\CreateMaterialDeleteNotification',
        ],
        'Pilot\Events\MaterialRated' => [
            'Pilot\Listeners\ChangeMaterialRate',
        ],
        'Pilot\Events\UserRated' => [
            'Pilot\Listeners\ChangeUserRate',
        ],
        'Pilot\Events\OrganizationRated' => [
            'Pilot\Listeners\ChangeOrganizationRate',
        ],
        'Pilot\Events\CourseSubscribed' => [
            'Pilot\Listeners\NotifyByEmail',
            'Pilot\Listeners\CreateCourseSubscribedNotification'
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
