<?php

namespace App\Http\Controllers\backend\application;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Section;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;

class ApplicationsController extends Controller
{
    public function index()
    {
        $data = Form::all();
        return view('backend.applications.index', compact('data'));
    }

    public function create()
    {
        $data = Section::query()
            ->orderBy('section_name', 'asc')
            ->get();

        return view('backend.applications.create', compact('data'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name_surname' => 'required',
            'nationality' => 'required',
            'passport_no' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'country' => 'required',
            'adress' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'high_school' => 'required',
            'high_school_country' => 'required',
            'high_school_city' => 'required',
            'year_of_graduation' => 'required',
            'graduation_degree' => 'required',
            'section_id' => 'required',
            'passport_photo' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'official_transcript' => 'required|file|mimes:pdf,xlsx,docx,doc|max:1024',
            'official_exam_name' => 'file|mimes:pdf,xlsx,docx,doc|max:1024',
            'section_id' => 'required',
            'checkbox_kvkk' => 'required',
            'checkbox_application_status' => 'required',
        ]);


    }
}

