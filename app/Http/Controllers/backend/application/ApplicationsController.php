<?php

namespace App\Http\Controllers\backend\application;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Request;

class ApplicationsController extends Controller
{
    public function index()
    {
        $data = Form::all();
        return view('backend.applications.index',compact('data'));
    }
}
