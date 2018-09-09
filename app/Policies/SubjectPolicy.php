<?php

namespace Pilot\Policies;

use Pilot\User;
use Pilot\Subject;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the subject.
     *
     * @param  \Pilot\User  $user
     * @param  \Pilot\Subject  $subject
     * @return mixed
     */
    public function view(User $user, Subject $subject)
    {
        //
    }

    /**
     * Determine whether the user can create subjects.
     *
     * @param  \Pilot\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the subject.
     *
     * @param  \Pilot\User  $user
     * @param  \Pilot\Subject  $subject
     * @return mixed
     */
    public function updateSubject(User $user, Subject $subject)
    {
        //
    }

    /**
     * Determine whether the user can delete the subject.
     *
     * @param  \Pilot\User  $user
     * @param  \Pilot\Subject  $subject
     * @return mixed
     */
    public function deleteSubject(User $user, Subject $subject)
    {
        //
    }
}
