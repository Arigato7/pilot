<?php

namespace Pilot\Policies;

use Pilot\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PracticalWorkPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
