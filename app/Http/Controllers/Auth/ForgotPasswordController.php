<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index(): View
    {
        return view('auth.forgot-password');
    }

    public function store(ForgotPasswordRequest $request)
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return redirect()
                ->route('auth.forgot-password.index')
                ->with('alert-type', 'success')
                ->with('alert-message', trans('passwords.sent'))
            ;
        }

        return redirect()
            ->route('auth.forgot-password.index')
            ->withInput()
            ->with('alert-type', 'error')
            ->with('alert-message', trans('passwords.user'))
        ;
    }
}
