<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class ResetPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index(Request $request, string $token): View
    {
        return view('auth.reset-password')
            ->with('token', $token)
            ->with('email', $request->get('email'))
        ;
    }

    public function store(ResetPasswordRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ]);

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()
                ->route('auth.login.index')
                ->with('alert-type', 'success')
                ->with('alert-message', trans($status))
            ;
        }

        return redirect()
            ->route('auth.reset-password.index', [
                'token' => $request->get('token'),
                'email' => $request->get('email'),
            ])
            ->withInput()
            ->with('alert-type', 'error')
            ->with('alert-message', trans($status))
        ;
    }
}
