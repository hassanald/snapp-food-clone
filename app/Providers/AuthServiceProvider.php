<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Address;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('seller-login', function (User $user) {
            return $user->role_id === Role::SELLER;
        });

        Gate::define('seller-all-capability' , function (){
            return count(auth()->user()->restaurants) !== 0;
        });

        Gate::define('can-update-address' , function (Address $address){
            return $address->user_id !== auth()->user()->id;
        });
    }
}
