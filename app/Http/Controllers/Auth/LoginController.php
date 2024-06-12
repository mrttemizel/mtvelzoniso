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
                ->route('backend.dashboard.index')
                ->with('success', 'You have successfully logged in.');
        }

        return redirect()
            ->route('auth.login.index')
            ->withInput()
            ->with('error', 'The Information Entered Is Not Correct!')
        ;
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();

        return redirect()
            ->route('auth.login.index')
            ->with('success', 'Your account has been logged out');
    }
}
