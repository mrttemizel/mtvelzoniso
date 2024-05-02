<?php

use App\Models\Form;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/form-toplam', function () {
    $total = Form::count();
    return response()->json(['total' => $total]);
});

Route::get('/form-onkabul', function () {
    $total = Form::where('application_status','2')->count();
    return response()->json(['total' => $total]);
});
