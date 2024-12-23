<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Offer;
use App\Models\Rent;
use App\Policies\UserPolicy;
use App\Policies\CarPolicy;
use App\Policies\OfferPolicy;
use App\Policies\RentPolicy;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Car::class => CarPolicy::class,
        Offer::class => OfferPolicy::class,
        Rent::class => RentPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('is-admin', function (User $user) {
           return $user->role_id == 1;
         });
        Gate::define('is-worker', function (User $user) {
            return $user->role_id == 2;
         });
        Gate::define('is-user', function (User $user) {
            return $user->role_id == 3;
         });

        Gate::define('is-admin-or-user', function (User $user) {
            return $user->role_id == 1 || $user->role_id == 3;
         });

        Gate::define('is-user-or-worker', function (User $user) {
            return $user->role_id == 2 || $user->role_id == 3;
         });

        Gate::define('is-admin-or-worker', function (User $user) {
            return $user->role_id == 1 || $user->role_id == 2;
         });
    }
}
