<?php

namespace App\Http\Controllers\Backend\Users;

use App\Http\Controllers\Controller;
use App\Managers\UserManager;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct(
        private readonly UserManager $userManager
    ) { }

    public function index(): View
    {
        $user = auth()->user();

        return view('backend.users.profile')
            ->with('user', $user)
        ;
    }

    public function update(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'min:11', 'max:11'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)]
        ]);

        return DB::transaction(function () use ($request, $user) {
            try {
                $this->userManager->update($user, [
                    'name' => $request->input('name'),
                    'phone' => $request->input('phone'),
                    'email' => $request->input('email')
                ]);

                return redirect()
                    ->route('backend.profile.index')
                    ->with('alert-type', 'success')
                    ->with('alert-message', trans('profile.success.update'));
            } catch (QueryException $e) {
                logger()->error($e);
                DB::rollBack();

                return redirect()
                    ->route('backend.agencies.index')
                    ->with('alert-type', 'error')
                    ->with('alert-message', trans('transactions.failed'));
            }
        });
    }

    public function updatePassword(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();

        $request->validate([
            'current_password' => ['required', 'string', 'max:255'],
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        return DB::transaction(function () use ($request, $user) {
            try {
                if (! Hash::check($request->input('current_password'), $user->password)) {
                    throw ValidationException::withMessages([
                        'current_password' => trans('validation.current_password')
                    ]);
                }

                $this->userManager->update($user, [
                    'password' => $request->input('password')
                ]);

                return redirect()
                    ->route('backend.profile.index')
                    ->with('alert-type', 'success')
                    ->with('alert-message', trans('profile.success.update-password'));
            } catch (QueryException $e) {
                logger()->error($e);
                DB::rollBack();

                return redirect()
                    ->route('backend.agencies.index')
                    ->with('alert-type', 'error')
                    ->with('alert-message', trans('transactions.failed'));
            }
        });
    }

    public function updateAvatar(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();

        $request->validate([
            'avatar' => ['image', 'mimes:jpg,jpeg,png,svg', 'max:1024']
        ]);

        return DB::transaction(function () use ($request, $user) {
            try {

                $this->userManager->uploadAvatar($user, $request->file('avatar'));

                return redirect()
                    ->route('backend.profile.index')
                    ->with('alert-type', 'success')
                    ->with('alert-message', trans('profile.success.update-password'));
            } catch (QueryException $e) {
                logger()->error($e);
                DB::rollBack();

                return redirect()
                    ->route('backend.agencies.index')
                    ->with('alert-type', 'error')
                    ->with('alert-message', trans('transactions.failed'));
            }
        });
    }
}
