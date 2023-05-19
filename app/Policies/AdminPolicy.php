<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{
    /**
     * Create a new policy instance.
     */
    public function admin(User $user)
    {
        return auth()->user()->is_admin;
    }

    public function adminSelf(User $admin, User $user)
    {
        // allowed if user is admin and is not deleting themselves
        return auth()->user()->is_admin && auth()->user()->id !== $user->id;
    }
}
