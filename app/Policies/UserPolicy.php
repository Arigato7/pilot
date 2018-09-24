<?php

namespace Pilot\Policies;

use Pilot\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
    /**
     * Возможность администрирования
     *
     * @param User $user
     * @return void
     */
    public function administrate(User $user) {
        return $user->role->name === 'administrator';
    }
    /**
     * Возможность модерирования
     *
     * @param User $user
     * @return void
     */
    public function moderate(User $user) {
        return $user->role->name === 'moderator' 
                || $user->role->name === 'administrator';
    }
    /**
     * Возможность редактирования данных пользователя
     *
     * @param User $user
     * @param User $model
     * @return void
     */
    public function edit(User $user, User $model) {
        return $user->id === $model->id;
    }
    /**
     * Возможность пользоваться материалами для преподавателей
     *
     * @param User $user
     * @return void
     */
    public function teach(User $user) {
        return $user->role->name === 'moderator' 
                || $user->role->name === 'administrator'
                || $user->role->name === 'teacher';
    }
}
