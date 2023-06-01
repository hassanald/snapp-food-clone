<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Role;
use App\Models\User;
use App\Policies\AddressPolicy;
use App\Policies\CartPolicy;
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
        Cart::class => CartPolicy::class,
        Address::class => AddressPolicy::class,
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


        Gate::define('can-update-cart-item' , function ($user , $cart_item){
            return $cart_item->cart->user_id === $user->id;
        });

        Gate::define('can-change-status' , function ($user , $order){
            return $order->restaurant->user->id === $user->id;
        });
    }
}
