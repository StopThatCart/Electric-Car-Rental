<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Offer;
use App\Models\User;

class OfferPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if($user->role_id == 1 || $user->role_id == 2) return true;
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Offer $offer): bool
    {
        if($user->role_id === 1) return true;
        $car = $offer->car;
        if ($user->brand_id != $car->brand_id) {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if($user->role_id == 1 || $user->role_id == 2) return true;
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Offer $offer): bool
    {
        if($user->role_id === 1) return true;
        return $user->brand_id === $offer->car->brand_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Offer $offer): bool
    {
        if($user->role_id === 1) return true;
        return $user->brand_id === $offer->car->brand_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Offer $offer): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Offer $offer): bool
    {
        return true;
    }
}
