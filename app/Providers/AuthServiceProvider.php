<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Illuminate\Contracts\Auth\Access\Authorizable;

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

        Gate::before(function ($user, $ability) {
            $user->permissions
                ->each(function ($permission, $index) use ($user) {
                    Gate::define($permission->name, function () use ($user, $permission) {
                        return $user->permissions->contains('name', $permission->name);
                    });
                });
        });
    }
}
