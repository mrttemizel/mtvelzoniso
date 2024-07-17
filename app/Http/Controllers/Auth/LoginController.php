<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        if (auth()->attempt($request->only(['email', 'password']))) {
            return redirect()
                ->route('backend.applications.index')
                ->with('alert-type', 'success')
                ->with('alert-message', trans('login.success.login'))
            ;
        }

        return redirect()
            ->route('auth.login.index')
            ->withInput()
            ->with('alert-type', 'error')
            ->with('alert-message', trans('login.errors.login'))
        ;
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();

        return redirect()
            ->route('auth.login.index')
            ->with('alert-type', 'success')
            ->with('alert-message', trans('login.success.logout'))
        ;
    }
}
