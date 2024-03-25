<?php

namespace App\Http\Controllers\backend\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /*  Kullanıcı İşlenleri  */


    public function create()
    {
        return view('backend.user.create');
    }

    public function store(Request $request)
    {
        if ($request->status == 4)
        {
            $request->validate([
                'name' => 'required',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required',
                'status' => 'required',
                'agency_name' => 'required|unique:users',
                'agency_code' => 'required|unique:users',
                'agency_tax_number' => 'required|unique:users',
            ]);
        }
        else{
            $request->validate([
                'name' => 'required',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required',
                'status' => 'required',
            ]);
        }

        $data = new User();

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpg,jpeg,png,svg|max:1024',
            ]);

            $imagename = str_replace([" ", "."], null, $request->input('name'));
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filname = $imagename . '-' . 'image' . '.' . $extention;
            $file->move('users', $filname);
            $data->image = $filname;
        }

        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');
        $data->agency_name = $request->input('agency_name');
        $data->agency_code = $request->input('agency_code');
        $data->agency_tax_number = $request->input('agency_tax_number');
        $data->status = $request->status;
        $data->password = Hash::make($request->input('password'));


        $query = $data->save();
        if (!$query) {
            return back()->with('error', 'Kullanıcı eklenirken bir hata oluştu!');
        } else {
            return back()->with('success', 'Kullanıcı ekleme başarılı.');
        }
    }

    public function index()
    {
        $data = User::all()->whereNotIn('status',[2]);
        return view('backend.user.index', compact('data'));
    }


    public function delete($id)
    {
        $data = User::find($id);

        $path = public_path() . '/users/' . $data->image;

        if (\File::exists($path)) {
            \File::delete($path);
        }
        $query = $data->delete();
        if (!$query) {
            return back()->with('error', 'Kullanıcı düzenlerken bir hata oluştu!');
        } else {
            return back()->with('success', 'Kullanıcı silme işlemi başarılı.');
        }
    }


    public function edit($id)
    {

        return view('backend.user.edit', [
            'data' => User::where('id', $id)->first(),
        ]);
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

            $path = public_path() . '/users/' . $data->image;

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

        if ($data->status == 3){
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
        }else{
            if ($data->email == $request->input('email')) {
                $request->validate([
                    'name' => 'required',
                    'email' => 'required|string|email|max:255',
                    'status' => 'required',
                ]);
            } else {
                $request->validate([
                    'name' => 'required',
                    'email' => 'required|string|email|max:255|unique:users',
                    'status' => 'required',
                ]);
            }

            $data->name = $request->input('name');
            $data->email = $request->input('email');
            $data->phone = $request->input('phone');
            $data->status = $request->status;

            $query = $data->update();

            if (!$query) {
                return redirect()->route('users.index')->with($notification_error);
            } else {
                return redirect()->route('users.index')->with($notification_success);
            }
        }

    }


    public  function password_update(Request $request)
    {
        $data = User::where('id', $request->input('id'))->first();

        if (Auth::user()->status == 0) {
            $validator = \Validator::make($request->all(), [

                'current_password' => ['required', function ($attribute, $value, $fail)  use ($data) {
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

            $path = public_path() . '/users/' . $data->image;

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
