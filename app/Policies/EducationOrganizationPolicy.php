<?php

namespace Pilot\Policies;

use Pilot\User;
use Pilot\EducationOrganization;
use Illuminate\Auth\Access\HandlesAuthorization;

class EducationOrganizationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the educationOrganization.
     *
     * @param  \Pilot\User  $user
     * @param  \Pilot\EducationOrganization  $educationOrganization
     * @return mixed
     */
    public function view(User $user, EducationOrganization $educationOrganization)
    {
        
    }

    /**
     * Determine whether the user can create educationOrganizations.
     *
     * @param  \Pilot\User  $user
     * @return mixed
     */
    public function createOrganization(User $user)
    {
        return $user->role->name === 'administrator';
    }

    /**
     * Возможность изменить данные организации
     *
     * @param  \Pilot\User  $user
     * @param  \Pilot\EducationOrganization  $educationOrganization
     * @return mixed
     */
    public function updateOrganization(User $user, EducationOrganization $educationOrganization)
    {
        return $user->role->name === 'administrator';
    }

    /**
     * Возможность удалить организацию
     *
     * @param  \Pilot\User  $user
     * @param  \Pilot\EducationOrganization  $educationOrganization
     * @return mixed
     */
    public function deleteOrganization(User $user, EducationOrganization $educationOrganization)
    {
        return $user->role->name === 'administrator' 
                && $educationOrganization->users->count() === 0;
    }
}
