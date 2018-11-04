<?php

namespace Pilot\Policies;

use Pilot\User;
use Pilot\Specialty;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpecialtyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the specialty.
     *
     * @param  \Pilot\User  $user
     * @param  \Pilot\Specialty  $specialty
     * @return mixed
     */
    public function view(User $user, Specialty $specialty)
    {
        //
    }

    /**
     * Determine whether the user can create specialties.
     *
     * @param  \Pilot\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the specialty.
     *
     * @param  \Pilot\User  $user
     * @param  \Pilot\Specialty  $specialty
     * @return mixed
     */
    public function update(User $user, Specialty $specialty)
    {
        //
    }

    /**
     * Determine whether the user can delete the specialty.
     *
     * @param  \Pilot\User  $user
     * @param  \Pilot\Specialty  $specialty
     * @return mixed
     */
    public function delete(User $user, Specialty $specialty)
    {
        //
    }
}
