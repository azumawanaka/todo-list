<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Services\LoginService;

class LoginController extends Controller
{
    /**
     * @var LoginService $loginService
     */
    private $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
        $this->middleware('guest')->except('logout');
    }

    public function login(LoginFormRequest $form): RedirectResponse
    {
        $loginUser = $this->loginService->login($form);
        if($loginUser) {
            Auth::loginUsingId($loginUser->id);
            return $this->loginService->redirectRouteByUser($loginUser);
        } else {
            return redirect()->back()->withErrors(['auth' => trans('auth.failed')])->withInput();
        }
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect('/login');
    }

    public function showLoginForm(): View
    {
        return view('auth.login');
    }
}
