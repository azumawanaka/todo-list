<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\LoginFormRequest;
use App\Models\User;

/**
 * Class LoginService.
 */
class LoginService
{
	/**
     * @return mixed
     */
    public function login(LoginFormRequest $form)
    {
        $loginUser =  User::where('email', $form->email)->first();
        if ($loginUser) {
            if(Hash::check($form->password, $loginUser->password)) {
                return $loginUser;
            }
        } else {
            return null;
        }
    }

    /**
     * @throw \Exception
     */
    public function redirectRouteByUser(User $loginUser): RedirectResponse
    {
        try {
            // $user = Auth::user();
            if ($loginUser->isAdminUser()) {
                return $this->routeToAdminPage();
            }
            if ($loginUser->isRegularUser()) {
                return $this->routeToUserPage();
            }
        } catch (\Exception $er) {
            \Log::error($er->getMessage());
            throw $er;
        }
    }

    public function routeToAdminPage(): RedirectResponse
    {
        return redirect()->intended(route('users.lists'));
    }

    public function routeToUserPage(): RedirectResponse
    {
        return redirect()->intended(route('user.home'));
    }
}
