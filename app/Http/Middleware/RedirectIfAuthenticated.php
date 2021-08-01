<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\LoginService;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        $loginService = app()->make(LoginService::class);

        if (Auth::guard($guard)->check()) {
            $loginUser = Auth::user();

            if($loginUser->isAdminUser()) {
                return $loginService->routeToAdminPage($loginUser);
            }

            if ($loginUser->isRegularUser()) {
                return $loginService->routeToUserPage($loginUser);
            }
        }

        return $next($request);
    }
}
