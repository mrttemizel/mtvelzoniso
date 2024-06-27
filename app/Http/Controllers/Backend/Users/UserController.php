<?php

namespace App\Http\Controllers\Backend\Users;

use App\Enums\UserStatusEnum;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Mail\Users\WelcomeMail;
use App\Models\Agency;
use App\Models\User;
use App\Managers\UserManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserStoreRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    public function __construct(
        protected UserManager $userManager
    ) { }

    public function index(): View
    {
        return view('backend.users.index');
    }

    public function create(): View
    {
        $agencies = Agency::query()->get();

        return view('backend.users.create')
            ->with('agencies', $agencies)
        ;
    }

    public function store(UserStoreRequest $request): RedirectResponse
    {
        return DB::transaction(function () use ($request) {
            try {
                $password = Str::random(8);

                /** @var User $user */
                $user = $this->userManager->create([
                    'agency_id' => $request->input('agency_id'),
                    'role' => $request->input('role'),
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => $password,
                    'phone' => $request->input('phone'),
                    'status' => UserStatusEnum::ACTIVE->value
                ]);

                if ($request->hasFile('avatar')) {
                    $this->userManager->uploadAvatar($user, $request->file('avatar'));
                }

                $user->setAttribute('raw_password', $password);

                Mail::to($request->input('email'))->queue(new WelcomeMail($user));

                return redirect()
                    ->route('backend.users.index')
                    ->with('alert-type', 'success')
                    ->with('alert-message', trans('users.success.created'))
                ;
            } catch (QueryException $e) {
                logger()->error($e);
                DB::rollBack();

                return redirect()
                    ->route('backend.users.index')
                    ->with('alert-type', 'error')
                    ->with('alert-message', trans('transactions.failed'))
                ;
            }
        });
    }

    public function edit(User $user): View
    {
        return view('backend.users.edit')
            ->with('user', $user)
        ;
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        return DB::transaction(function () use ($request, $user) {
            try {
                /** @var User $user */
                $user = $this->userManager->update($user, [
                    'agency_id' => $request->input('agency_id'),
                    'role' => $request->input('role'),
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                ]);

                if ($request->hasFile('avatar')) {
                    $this->userManager->uploadAvatar($user, $request->file('avatar'));
                }

                return redirect()
                    ->route('backend.users.index')
                    ->with('alert-type', 'success')
                    ->with('alert-message', trans('users.success.updated'))
                    ;
            } catch (QueryException $e) {
                logger()->error($e);
                DB::rollBack();

                return redirect()
                    ->route('backend.users.index')
                    ->with('alert-type', 'error')
                    ->with('alert-message', trans('transactions.failed'))
                ;
            }
        });
    }

    public function destroy(User $user)
    {
        return DB::transaction(function () use ($user) {
            try {
                $this->userManager->delete($user);

                return redirect()
                    ->route('backend.users.index')
                    ->with('alert-type', 'success')
                    ->with('alert-message', trans('users.success.deleted'))
                    ;
            } catch (QueryException $e) {
                logger()->error($e);
                DB::rollBack();

                return redirect()
                    ->route('backend.users.index')
                    ->with('alert-type', 'error')
                    ->with('alert-message', trans('transactions.failed'))
                ;
            }
        });
    }

    public function resetPassword(User $user): RedirectResponse
    {
        /** @var User $authorizedUser */
        $authorizedUser = auth()->user();

        if (! $authorizedUser->isAllAdmin() && $authorizedUser->agency_id != $user->agency_id) {
            return redirect()
                ->route('backend.users.index')
                ->with('alert-type', 'error')
                ->with('alert-message', trans('auth.unauthorized'))
            ;
        }

        $status = Password::sendResetLink([
            'email' => $user->email
        ]);

        if ($status == Password::RESET_LINK_SENT) {
            return redirect()
                ->route('backend.users.index')
                ->with('alert-type', 'success')
                ->with('alert-message', trans('users.success.reset-password'))
            ;
        }

        return redirect()
            ->route('backend.users.index')
            ->with('alert-type', 'error')
            ->with('alert-message', trans('users.errors.reset-password'))
        ;
    }

    public function dataTable(): JsonResponse
    {
        $model = User::query()
            ->orderByDesc('id')
        ;

        return datatables()
            ->eloquent($model)
            ->addColumn('actions', function ($item) {
                return view('backend._partials.datatables._users-actions')
                    ->with('editRoute', route('backend.users.edit', ['userId' => $item->id]))
                    ->with('resetPasswordLink', route('backend.users.reset-password', ['userId' => $item->id]))
                    ->with('deleteRoute', route('backend.users.destroy', ['userId' => $item->id]))
                ;
            })
            ->toJson();
    }



    public function image_update(Request $request)
    {
        $notification_success = array(
            'message' => 'Güncelleme Başarılı',
            'alert-type' => 'success'
        );

        $notification_error = array(
            'message' => 'Güncelleme Başarısız',
            'alert-type' => 'error'
        );

        $data = User::where('id', $request->id)->first();

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpg,jpeg,png,svg|max:1024',
            ]);

            $path = public_path() . '/Users/' . $data->image;

            if (\File::exists($path)) ;
            {
                \File::delete($path);
            }
            $imagename = str_replace([" ", "."], null, $data->name);
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filname = $imagename . '-' . 'image' . '.' . $extention;
            $file->move('users', $filname);
            $data->image = $filname;
        }

        $query = $data->update();

        if (!$query) {
            return back()->with($notification_error);
        } else {
            return back()->with($notification_success);
        }

    }

    public function information_update(Request $request)
    {
        $notification_success = array(
            'message' => 'Güncelleme Başarılı',
            'alert-type' => 'success'
        );

        $notification_error = array(
            'message' => 'Güncelleme Başarısız',
            'alert-type' => 'error'
        );

        $data = User::where('id', $request->input('id'))->first();

        if ($data->status == 3) {
            if ($data->email == $request->input('email')) {
                $request->validate([
                    'name' => 'required',
                    'email' => 'required|string|email|max:255',

                ]);
            } else {
                $request->validate([
                    'name' => 'required',
                    'email' => 'required|string|email|max:255|unique:users',

                ]);
            }

            $data->name = $request->input('name');
            $data->email = $request->input('email');
            $data->phone = $request->input('phone');

            $data->status = 3;

            $query = $data->update();


            if (!$query) {
                return redirect()->route('users.index')->with($notification_error);
            } else {
                return redirect()->route('users.index')->with($notification_success);
            }
        } else {
            if ($data->email == $request->input('email')) {
                $request->validate([
                    'name' => 'required',
                    'email' => 'required|string|email|max:255',
                    'status' => 'required',
                    'agency_name' => 'required',
                    'agency_code' => 'required',
                ]);
            } else {
                $request->validate([
                    'name' => 'required',
                    'email' => 'required|string|email|max:255|unique:users',
                    'status' => 'required',
                    'agency_name' => 'required|unique:users',
                    'agency_code' => 'required|unique:users',
                    'agency_tax_number' => 'unique:users',
                ]);
            }

            $data->name = $request->input('name');
            $data->email = $request->input('email');
            $data->phone = $request->input('phone');
            $data->agency_name = $request->input('agency_name');
            $data->agency_code = $request->input('agency_code');
            $data->agency_tax_number = $request->input('agency_tax_number');
            $data->status = $request->status;


            if ($request->hasFile('vergi_levhasi')) {
                $request->validate([
                    'vergi_levhasi' => 'file|mimes:pdf,xlsx,docx,doc|max:2048',
                ]);

                $path1 = public_path() . '/Users/' . $data->vergi_levhasi;

                if (\File::exists($path1)) ;
                {
                    \File::delete($path1);
                }

                $vergi_levhasi = $request->file('vergi_levhasi');
                $vergi_levhasi_name = 'VL' . '-' . $request->input('agency_name') . '-' . time() . '.' . $vergi_levhasi->getClientOriginalExtension();
                $vergi_levhasi->move('users', $vergi_levhasi_name);
                $data->vergi_levhasi = $vergi_levhasi_name;
            }


            if ($request->hasFile('sozlesme')) {
                $request->validate([
                    'sozlesme' => 'file|mimes:pdf,xlsx,docx,doc|max:2048',
                ]);

                $path2 = public_path() . '/Users/' . $data->sozlesme;

                if (\File::exists($path2)) ;
                {
                    \File::delete($path2);
                }
                $sozlesme = $request->file('sozlesme');
                $sozlesme_name = 'SZ' . '-' . $request->input('agency_name') . '-' . time() . '.' . $sozlesme->getClientOriginalExtension();
                $sozlesme->move('users', $sozlesme_name);
                $data->sozlesme = $sozlesme_name;
            }

            $query = $data->update();

            if (!$query) {
                return redirect()->route('users.index')->with($notification_error);
            } else {
                return redirect()->route('users.index')->with($notification_success);
            }
        }

    }


    public function password_update(Request $request)
    {
        $data = User::where('id', $request->input('id'))->first();

        if (Auth::user()->status == 0) {
            $validator = \Validator::make($request->all(), [

                'current_password' => ['required', function ($attribute, $value, $fail) use ($data) {
                    if (!\Hash::check($value, $data->password)) {
                        return $fail(__('The current password is incorrect.'));
                    }
                }],
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required',
            ]);

        } else {
            $validator = \Validator::make($request->all(), [
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required',
            ]);
        }

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data->password = Hash::make($request->password);
            $query = $data->update();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'NO']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Şifre Değiştirme İşlemi Başarılı']);
            }
        }


    }


    /*  Kullanıcı İşlenleri Bitti */


    /*  Profil İşlenleri  */

    public function profile()
    {
        $data = User::where('id', Auth::user()->id)->first();
        return view('backend.user.profile', compact('data'));
    }

    public function profile_image_update(Request $request)
    {
        $notification_success = array(
            'message' => 'Güncelleme Başarılı',
            'alert-type' => 'success'
        );

        $notification_error = array(
            'message' => 'Güncelleme Başarısız',
            'alert-type' => 'error'
        );

        $data = User::where('id', Auth::user()->id)->first();

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpg,jpeg,png,svg|max:1024',
            ]);

            $path = public_path() . '/Users/' . $data->image;

            if (\File::exists($path)) ;
            {
                \File::delete($path);
            }
            $imagename = str_replace([" ", "."], null, $data->name);
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filname = $imagename . '-' . 'image' . '.' . $extention;
            $file->move('users', $filname);
            $data->image = $filname;
        }

        $query = $data->update();

        if (!$query) {
            return back()->with($notification_error);
        } else {
            return back()->with($notification_success);
        }


    }


    public function profile_information_update(Request $request)
    {

        $notification_success = array(
            'message' => 'Güncelleme Başarılı',
            'alert-type' => 'success'
        );

        $notification_error = array(
            'message' => 'Güncelleme Başarısız',
            'alert-type' => 'error'
        );

        $data = User::where('id', Auth::user()->id)->first();

        if ($data->email == $request->input('email')) {
            $request->validate([
                'name' => 'required',
                'email' => 'required|string|email|max:255',
            ]);
        } else {
            $request->validate([
                'name' => 'required',
                'email' => 'required|string|email|max:255|unique:users',
            ]);
        }
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');

        $query = $data->update();

        if (!$query) {
            return back()->with($notification_error);
        } else {
            return back()->with($notification_success);
        }

    }

    public function profile_password_update(Request $request)
    {

        $data = User::where('id', Auth::user()->id)->first();

        $validator = \Validator::make($request->all(), [

            'current_password' => ['required', function ($attribute, $value, $fail) use ($data) {
                if (!\Hash::check($value, $data->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data->password = Hash::make($request->password);
            $query = $data->update();
            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'NO']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Şifre Değiştirme İşlemi Başarılı']);
            }
        }

    }

    /*  Profil İşlenleri  Bitti */


}
