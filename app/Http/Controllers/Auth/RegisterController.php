<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function index(): View
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        return DB::transaction(function () use ($request) {
            try {
                /** @var User $user */
                $user = User::query()->create([
                    'role' => User::ROLE_STUDENT,
                    'email' => $request->input('email'),
                    'name' => $request->input('name'),
                    'password' => bcrypt($request->input('password')),
                ]);
            } catch (QueryException $e) {
                logger()->error($e);
                DB::rollBack();

                return redirect()
                    ->route('auth.register')
                    ->withInput()
                    ->with('alert-type', 'error')
                    ->with('alert-message', trans('transactions.failed'))
                ;
            }

            auth()->login($user);

            return redirect()
                ->route('backend.dashboard.index')
                ->with('alert-type', 'success')
                ->with('alert-message', trans('register.success.created'))
            ;
        });
    }
}
