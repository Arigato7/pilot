<?php

namespace Pilot\Policies;

use Pilot\User;
use Pilot\Material;
use Illuminate\Auth\Access\HandlesAuthorization;

class MaterialComplaintPolicy
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
    /**
     * Undocumented function
     *
     * @param User $user
     * @param Material $material
     * @return void
     */
    public function createMaterialComplaint(User $user, Material $material) {
        return $material->complaints->whereIn('user_id', [$user->id])->count() === 0;
    }
}
