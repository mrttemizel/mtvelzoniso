<?php



use App\Http\Controllers\backend\auth\AuthController;
use App\Http\Controllers\backend\letter\LetterController;
use App\Http\Controllers\backend\sections\SectionsController;
use App\Http\Controllers\backend\user\UserController;
use App\Http\Controllers\backend\form\FormController;
use Illuminate\Support\Facades\Route;


Route::get('/',function () {
   return view('frontend.index');
})->name('frontend.index');


Route::get('/login',[AuthController::class,'login'])->name('auth.login');
Route::post('/store',[AuthController::class,'store'])->name('auth.store');
Route::post('/login-submit',[AuthController::class,'login_submit'])->name('auth.login-submit');
Route::get('/reset-password',[AuthController::class,'reset_password_page'])->name('auth.reset_password');
Route::post('/reset-password-link',[AuthController::class,'reset_password_link'])->name('auth.reset-password-link');
Route::get('/admin/reset-password/{token}/{email}',[AuthController::class,'reset_password'])->name('auth.reset_password_link');
Route::post('/reset-password-submit',[AuthController::class,'reset_password_submit'])->name('auth.reset_password_submit');


Route::middleware('auth')->group(function (){
    Route::prefix('dashboard')->group(function(){

        Route::get('/guest',function () {
            return view('backend.guest');
        })->name('auth.guest');

        Route::get('/',[AuthController::class,'index'])->name('auth.index')->middleware('adminStatus');;
        Route::get('/logout',[AuthController::class,'logout'])->name('auth.logout');


        Route::get('/profile',[UserController::class,'profile'])->name('user.profile');
        Route::post('/profile/profile-image-update',[UserController::class,'profile_image_update'])->name('users.profile.image.update');
        Route::post('/profile/profile-information-update',[UserController::class,'profile_information_update'])->name('users.profile.information.update');
        Route::post('/profile/profile-password-update',[UserController::class,'profile_password_update'])->name('users.profile.password.update');

        Route::get('/users/create',[UserController::class,'create'])->name('users.create')->middleware('adminStatus');
        Route::post('/users/store',[UserController::class,'store'])->name('users.store')->middleware('adminStatus');
        Route::get('/users/index',[UserController::class,'index'])->name('users.index')->middleware('adminStatus');
        Route::get('/users/delete/{id}',[UserController::class,'delete'])->name('users.delete')->middleware('adminStatus');
        Route::get('/users/edit/{id}',[UserController::class,'edit'])->name('users.edit')->middleware('adminStatus');
        Route::post('/user/image-update',[UserController::class,'image_update'])->name('users.image.update')->middleware('adminStatus');
        Route::post('/user/information-update',[UserController::class,'information_update'])->name('users.information.update')->middleware('adminStatus');
        Route::post('/user/password-update',[UserController::class,'password_update'])->name('users.password.update')->middleware('adminStatus');

        Route::get('/sections/index',[SectionsController::class,'index'])->name('sections.index')->middleware('CheckRole');
        Route::post('/sections/store',[SectionsController::class,'store'])->name('sections.store')->middleware('CheckRole');
        Route::get('/sections/delete/{id}',[SectionsController::class,'delete'])->name('sections.delete')->middleware('CheckRole');;


        Route::get('/form/index',[FormController::class,'index'])->name('form.index');
        Route::get('/form/create',[FormController::class,'create'])->name('form.create');
        Route::post('/form/store',[FormController::class,'store'])->name('form.store');
        Route::get('/form/see/{id}',[FormController::class,'see'])->name('form.see');
        Route::get('/form/edit/{id}',[FormController::class,'edit'])->name('form.edit')->middleware('adminStatus');
        Route::get('/form/delete/{id}',[FormController::class,'delete'])->name('form.delete')->middleware('adminStatus');
        Route::post('/form/update',[FormController::class,'update'])->name('form.update')->middleware('adminStatus');


        Route::post('/letter/send-pre-letter',[LetterController::class,'send_pre_letter'])->name('letter.send-pre-letter')->middleware('adminStatus');


    });
});
