<?php

namespace App\Providers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('admin', function($user) {
            if ($user->isAdminUser()) {
                return $user->role == 1;
            }

            return false;
        });

        Gate::define('user', function($user) {
            if ($user->isRegularUser()) {
                return $user->role == 0;
            }

            return false;
        });

        Passport::routes();

        Route::group(['middleware' => 'oauth.providers'], function () {
            Passport::routes(function ($router) {
                return $router->forAccessTokens();
            });
        });
    }
}
