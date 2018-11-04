<?php

namespace Pilot\Policies;

use Pilot\User;
use Pilot\Material;
use Illuminate\Auth\Access\HandlesAuthorization;

class MaterialPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the material.
     *
     * @param  \Pilot\User  $user
     * @param  \Pilot\Material  $material
     * @return mixed
     */
    public function view(User $user, Material $material)
    {
        //
    }

    /**
     * Determine whether the user can create materials.
     *
     * @param  \Pilot\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the material.
     *
     * @param  \Pilot\User  $user
     * @param  \Pilot\Material  $material
     * @return mixed
     */
    public function updateMaterial(User $user, Material $material)
    {
        return $user->id === $material->user_id;
    }

    /**
     * Determine whether the user can delete the material.
     *
     * @param  \Pilot\User  $user
     * @param  \Pilot\Material  $material
     * @return mixed
     */
    public function deleteMaterial(User $user, Material $material)
    {
        return $user->id === $material->user_id;
    }
    /**
     * Undocumented function
     *
     * @param User $user
     * @param Material $material
     * @return void
     */
    public function createMaterialComment(User $user, Material $material) {
        return $material->comments->whereIn('user_id', [$user->id])->count() === 0;
    }
}
