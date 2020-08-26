<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /**
         * Defining the user Roles
         */
        Gate::define('isAdmin', function ($user) {
            return !empty($user->role->where('name', 'Admin')->first());
        });

        Gate::define('isUser', function ($user) {
            return !empty($user->role->where('name', 'User')->first());
        });
    }
}
