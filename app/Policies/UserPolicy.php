<?php

namespace Pilot\Policies;

use Pilot\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function administrate(User $user) {
        return $user->role->name === 'administrator';
    }
    public function moderate(User $user) {
        return $user->role->name === 'moderator' 
                || $user->role->name === 'administrator';
    }
    public function edit(User $user, User $model) {
        return $user->id === $model->id;
    }
    public function teach(User $user) {
        return $user->role->name === 'moderator' 
                || $user->role->name === 'administrator'
                || $user->role->name === 'teacher';
    }
}
