<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdministrator', function ($user) {
            return $user->type === 'Administrator';
        });
        Gate::define('isCustomer', function ($user) {
            return $user->type === 'Customer';
        });
        Gate::define('isStaff', function ($user) {
            return $user->type === 'Staff';
        });
        Gate::define('isPart-Timer', function ($user) {
            return $user->type === 'Part-Timer';
        });
        Gate::define('isDriver', function ($user) {
            return $user->type === 'Driver';
        });
        Gate::define('isMerchant', function ($user) {
            return $user->type === 'Merchant';
        });

        Passport::routes();
        //
    }
}
