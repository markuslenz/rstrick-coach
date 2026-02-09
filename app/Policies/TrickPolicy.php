<?php

namespace App\Policies;

use App\Models\Trick;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TrickPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Anyone can view a list of Judge Types
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Trick $trick): bool
    {
        return true; // Anyone can view a list of Judge Types
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->canEdit();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Trick $trick): bool
    {
        return $user->canEdit();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Trick $trick): bool
    {
        return $user->canEdit();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Trick $trick): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Trick $trick): bool
    {
        return $user->canEdit();
    }
}
