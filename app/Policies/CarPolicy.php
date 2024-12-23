<?php

namespace App\Policies;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\Gate;
use Illuminate\Auth\Access\Response;
use App\Models\Car;
use App\Models\Brand;
use App\Models\User;



class CarPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if($user->role_id == 1 || $user->role_id == 2) return true;
        return false;
    }

    public function view(User $user, Car $car): bool
    {
        if($user->role_id == 1) return true;
        if ($user->brand_id != $car->brand_id) {
            return false;
        }
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role_id == 1;
    }

    public function update(User $user, Car $car): bool
    {
        //Sprawdza, czy admin
        if($user->role_id == 1) return true;
        //Sprawdza, czy pracownik nie próbuje przypadkiem przypisać markę "none" do samochodu
        if($car->brand_id == 1){
            return false;
        }
        $brand = Brand::find($car->brand_id);
        if ($user->brand_id == $brand->id) {
            return true;
        }
        return false;
    }

    public function delete(User $user, Car $car): bool
    {
        return $user->role_id == 1;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Car $car): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Car $car): bool
    {
        return $user->role_id == 1;
    }
}
