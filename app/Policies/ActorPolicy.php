<?php

namespace App\Policies;

use App\Models\User;

class ActorPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function create(User $user, $model = null): bool
{
    return $user->role_id == 2;
}
}
