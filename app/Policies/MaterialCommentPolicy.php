<?php

namespace Pilot\Policies;

use Pilot\User;
use Pilot\Material;
use Pilot\MaterialComment;
use Illuminate\Auth\Access\HandlesAuthorization;

class MaterialCommentPolicy
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
    public function createMaterialComment(User $user, Material $material) {
        return $material->comments->whereIn('user_id', [$user->id])->count() === 0;
    }
}
