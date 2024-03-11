<?php

namespace App\Http\Controllers\frontend\form;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class FormController extends Controller
{
   public  function index()
   {
       $data = Section::query()
           ->orderBy('section_name', 'asc')
           ->get();

       return view('frontend.form',compact('data'));
   }

   public  function store(Request $request)
   {
       $validator = \Validator::make($request->all(),[
           'name_surname' => 'required',
           'country' => 'required',
           'passport_no' => 'required',
           'place_of_birth' => 'required',
           'date_of_birth' => 'required',
           'passaport_photo' => 'required|file|mimes:pdf,xlsx,docx,doc|max:5120',
           'country' => 'required',
           'adress' => 'required',
           'phone_number' => 'required',
           'email' => 'required',
           'high_school' => 'required',
           'high_school_country' => 'required',
           'high_school_city' => 'required',
           'year_of_graduation' => 'required',
           'graduation_degree' => 'required',
           'official_transcript' => 'required|file|mimes:pdf,xlsx,docx,doc|max:5120',
           'official_exam' => 'file|mimes:pdf,xlsx,docx,doc|max:5120',
           'preference_one' => 'required',
           'preference_two' => 'required',
           'checkbox_application_status' => 'required',
           'checkbox_kvkk' => 'required',
           'g-recaptcha-response' => 'recaptcha',
           'g-recaptcha-response' => 'required',

       ]);
       if (!$validator->passes()){
           return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
       }else{




           return response()->json(['code' => 1, 'success' => 'Your message has been sent successfully']);
       }

   }
}
