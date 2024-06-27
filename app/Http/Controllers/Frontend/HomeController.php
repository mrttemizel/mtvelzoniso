<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    public function index(): RedirectResponse
    {
        if (auth()->check()) {
            return redirect()->route('backend.dashboard.index');
        }

        return redirect()->route('auth.login.index');
    }
}
