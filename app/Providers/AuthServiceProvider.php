<?php

namespace Pilot\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Pilot\User' => 'Pilot\Policies\UserPolicy',
        'Pilot\Course' => 'Pilot\Policies\CoursePolicy',
        'Pilot\Material' => 'Pilot\Policies\MaterialPolicy',
        'Pilot\MaterialComplaint' => 'Pilot\Policies\MaterialComplaintPolicy',
        'Pilot\EducationOrganization' => 'Pilot\Policies\EducationOrganizationPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
