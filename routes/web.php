<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\backend\basvurular\BasvurularController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\backend\form\FormController;
use App\Http\Controllers\backend\sections\SectionsController;
use App\Http\Controllers\backend\user\UserController;
use App\Http\Controllers\Backend\Users\ProfileController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('frontend.index');

Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('auth.login.index');
    Route::post('/login', [LoginController::class, 'store'])->name('auth.login.store');

    Route::get('/register', [RegisterController::class, 'index'])->name('auth.register.index');
    Route::post('/register', [RegisterController::class, 'store'])->name('auth.register.store');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('auth.forgot-password.index');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->name('auth.forgot-password.store');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'index'])->name('auth.reset-password.index');
    Route::post('/reset-password/{token}', [ResetPasswordController::class, 'store'])->name('auth.reset-password.store');

    Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');
});

Route::prefix('dashboard')->middleware(['auth'])->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('backend.dashboard.index');

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('backend.profile.index');
        Route::post('/update-avatar', [ProfileController::class, 'updateAvatar'])->name('backend.profile.update-avatar');
    });

    Route::prefix('users')->group(function () {

    });

//    Route::get('/profile',[UserController::class,'profile'])->name('user.profile');
//    Route::post('/profile/profile-image-update',[UserController::class,'profile_image_update'])->name('users.profile.image.update');
//    Route::post('/profile/profile-information-update',[UserController::class,'profile_information_update'])->name('users.profile.information.update');
//    Route::post('/profile/profile-password-update',[UserController::class,'profile_password_update'])->name('users.profile.password.update');

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

    Route::post('/form/send-pre-letter',[FormController::class,'send_pre_letter'])->name('form.send_pre_letter')->middleware('adminStatus');


    Route::get('/basvurular/degerlendirmeyi_bekleyenler',[BasvurularController::class,'degerlendirmeyi_bekleyenler'])->name('basvurular.degerlendirmeyi_bekleyenler')->middleware('adminStatus');;
    Route::get('/basvurular/on_kabul_almislar',[BasvurularController::class,'on_kabul_almislar'])->name('basvurular.on_kabul_almislar')->middleware('adminStatus');;
    Route::get('/basvurular/resmi_kabul_almislar',[BasvurularController::class,'resmi_kabul_almislar'])->name('basvurular.resmi_kabul_almislar')->middleware('adminStatus');;
    Route::get('/basvurular/tum_basvurular',[BasvurularController::class,'tum_basvurular'])->name('basvurular.tum_basvurular')->middleware('adminStatus');;

});

