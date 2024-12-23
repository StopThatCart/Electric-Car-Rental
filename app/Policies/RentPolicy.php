<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Rent;
use App\Models\User;

class RentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
       return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Rent $rent): bool
    {
        if($user->role_id === 1) return true;
        if($user->id === $rent->user_id) return true;
        if($user->brand_id === $rent->offer->car->brand_id) return true;
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if($user->role_id == 3) return true;
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Rent $rent): bool
    {
        if($user->role_id === 1) return true;
        if($user->id == $rent->user_id) return true;
        return $user->brand_id === $rent->offer->car->brand_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Rent $rent): bool
    {
        if($user->role_id === 1) return true;
        if($rent->state != "Canceled" && $rent->state != "Returned") return false;
        return $user->brand_id === $rent->offer->car->brand_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Rent $rent): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Rent $rent): bool
    {
        return true;
    }
}
