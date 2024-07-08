<?php

namespace App\Providers;

use App\Models\Agency;
use App\Models\Application;
use App\Models\Department;
use App\Models\EmailTemplate;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->routeBindings();

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    public function routeBindings(): void
    {
        Route::model('agencyId', Agency::class);
        Route::model('userId', User::class);
        Route::model('departmentId', Department::class);
        Route::model('applicationId', Application::class);
        Route::model('emailTemplateId', EmailTemplate::class);
    }
}
