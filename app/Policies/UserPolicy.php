<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, User $model): bool
    {
        return $user->role_id == 1;
    }

    public function viewSelf(User $user, User $model): bool
    {
        if ($user->role_id == 1) {
            return true;
        }else if ($user->id == $model->id) {
            return true;
        }else return false;

    }

    public function update(User $user, User $model): bool
    {
        return $user->role_id == 1;
    }


    public function delete(User $user, User $model): bool
    {
        //Sprawdza, czy admin nie chce usunąć samego siebie
        if ($user->id == $model->id && $user->role_id == 1) {
            return false;
        }else if ($user->role_id == 2) {
            return false;
        }else if ($user->id == $model->id && $user->role_id == 3) {
            return true;
        }
        return $user->role_id == 1;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return$user->role_id == 1;
    }
}
