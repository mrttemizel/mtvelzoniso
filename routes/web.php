<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Backend\Agencies\AgencyController;
use App\Http\Controllers\Backend\Application\ApplicationController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Departments\DepartmentController;
use App\Http\Controllers\Backend\EmailTemplates\EmailTemplateController;
use App\Http\Controllers\Backend\Users\UserController;
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

Route::prefix('dashboard')->middleware(['auth', 'isActive'])->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('backend.dashboard.index');

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('backend.profile.index');

        Route::post('/', [ProfileController::class, 'update'])->name('backend.profile.update');
        Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('backend.profile.update-password');

        Route::post('/update-avatar', [ProfileController::class, 'updateAvatar'])->name('backend.profile.update-avatar');
    });

    Route::prefix('agencies')->group(function () {
        Route::get('/', [AgencyController::class, 'index'])->name('backend.agencies.index');
        Route::get('/datatable', [AgencyController::class, 'dataTable'])->name('backend.agencies.dataTable');

        Route::get('/create', [AgencyController::class, 'create'])->name('backend.agencies.create');
        Route::post('/create', [AgencyController::class, 'store'])->name('backend.agencies.store');

        Route::get('/edit/{agencyId}', [AgencyController::class, 'edit'])->name('backend.agencies.edit');
        Route::post('/edit/{agencyId}', [AgencyController::class, 'update'])->name('backend.agencies.update');

        Route::post('/suspend', [AgencyController::class, 'suspend'])->name('backend.agencies.suspend');

//        Route::post('/delete/{agencyId}', [AgencyController::class, 'destroy'])->name('backend.agencies.destroy');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('backend.users.index');
        Route::get('/datatable', [UserController::class, 'dataTable'])->name('backend.users.dataTable');

        Route::post('/reset-password/{userId}', [UserController::class, 'resetPassword'])->name('backend.users.reset-password');

        Route::get('/create', [UserController::class, 'create'])->name('backend.users.create');
        Route::post('/create', [UserController::class, 'store'])->name('backend.users.store');

        Route::get('/edit/{userId}', [UserController::class, 'edit'])->name('backend.users.edit');
        Route::post('/edit/{userId}', [UserController::class, 'update'])->name('backend.users.update');

        Route::post('/delete/{userId}', [UserController::class, 'destroy'])->name('backend.users.destroy');
    });

    Route::prefix('departments')->group(function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('backend.departments.index');
        Route::get('/datatable', [DepartmentController::class, 'dataTable'])->name('backend.departments.dataTable');

        Route::get('/create', [DepartmentController::class, 'create'])->name('backend.departments.create');
        Route::post('/create', [DepartmentController::class, 'store'])->name('backend.departments.store');

        Route::get('/edit/{departmentId}', [DepartmentController::class, 'edit'])->name('backend.departments.edit');
        Route::post('/edit/{departmentId}', [DepartmentController::class, 'update'])->name('backend.departments.update');

        Route::post('/delete/{departmentId}', [DepartmentController::class, 'destroy'])->name('backend.departments.destroy');
    });

    Route::prefix('applications')->group(function () {
        Route::get('/', [ApplicationController::class, 'index'])->name('backend.applications.index');
        Route::get('/statistics', [ApplicationController::class, 'statistics'])->name('backend.applications.statistics');
        Route::get('/download/{applicationId}', [ApplicationController::class, 'download'])->name('backend.applications.download');

        Route::get('/columns', [ApplicationController::class, 'getColumns'])->name('backend.applications.get-columns');
        Route::get('/datatable', [ApplicationController::class, 'dataTable'])->name('backend.applications.dataTable');

        Route::get('/create', [ApplicationController::class, 'create'])->name('backend.applications.create');
        Route::post('/create', [ApplicationController::class, 'store'])->name('backend.applications.store');

        Route::get('/edit/{applicationId}', [ApplicationController::class, 'edit'])->name('backend.applications.edit');
        Route::post('/edit/{applicationId}', [ApplicationController::class, 'update'])->name('backend.applications.update');

        Route::post('/delete/{applicationId}', [ApplicationController::class, 'destroy'])->name('backend.applications.destroy');

        Route::post('/update-status', [ApplicationController::class, 'updateStatus'])->name('backend.applications.update-status');
        Route::post('/upload-payment', [ApplicationController::class, 'uploadPayment'])->name('backend.applications.upload-payment');
    });

    Route::prefix('email-templates')->group(function () {
        Route::get('/', [EmailTemplateController::class, 'index'])->name('backend.email-templates.index');
        Route::get('/datatable', [EmailTemplateController::class, 'dataTable'])->name('backend.email-templates.dataTable');

        Route::get('/create', [EmailTemplateController::class, 'create'])->name('backend.email-templates.create');
        Route::post('/create', [EmailTemplateController::class, 'store'])->name('backend.email-templates.store');

        Route::get('/edit/{emailTemplateId}', [EmailTemplateController::class, 'edit'])->name('backend.email-templates.edit');
        Route::post('/edit/{emailTemplateId}', [EmailTemplateController::class, 'update'])->name('backend.email-templates.update');

        Route::post('/delete/{emailTemplateId}', [EmailTemplateController::class, 'destroy'])->name('backend.email-templates.destroy');
    });
});
