<?php

namespace App\Http\Controllers\frontend\form;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Section;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use TimeHunter\LaravelGoogleReCaptchaV2\Validations\GoogleReCaptchaV2ValidationRule;

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
           'about_us' => 'required',

           'checkbox_kvkk' => 'required',
           'checkbox_application_status' => 'required',
           'g-recaptcha-response' => [new GoogleReCaptchaV2ValidationRule()]

       ]);
       if (!$validator->passes()){
           return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
       }else{

            $data = New Form();

           $basvuru_id = IdGenerator::generate(['table' => 'forms', 'field' => 'basvuru_id', 'length' => 10, 'prefix' => 'BSV-']);

           $data->name_surname = $request->input('name_surname');
            $data->nationality = $request->input('nationality');
            $data->passport_no = $request->input('passport_no');
            $data->place_of_birth = $request->input('place_of_birth');
            $data->date_of_birth = $request->input('date_of_birth');
            $data->country = $request->input('country');
            $data->adress = $request->input('adress');
            $data->phone_number = $request->input('phone_number');
            $data->email = $request->input('email');
            $data->high_school = $request->input('high_school');
            $data->high_school_country = $request->input('high_school_country');
            $data->high_school_city = $request->input('high_school_city');
            $data->year_of_graduation = $request->input('year_of_graduation');
            $data->graduation_degree = $request->input('graduation_degree');
            $data->section_id = $request->input('section_id');


           $data->basvuru_id = $basvuru_id;

           if ($request->hasFile('passport_photo')) {

               $passport_photo = $request->file('passport_photo');
               $passport_photo_name = $request->input('name_surname') . '-' . 'Passport' . '-' . time() . '-' . uniqid() . '.' . $passport_photo->getClientOriginalExtension();
               $passport_photo->move('form/', $passport_photo_name);
               $data->passport_photo = $passport_photo_name;

           }

           if ($request->hasFile('official_transcript')) {

               $official_transcript = $request->file('official_transcript');
               $official_transcript_name = $request->input('name_surname') . '-' . 'Transcript' . '-' . time() . '-' . uniqid() . '.' . $official_transcript->getClientOriginalExtension();
               $official_transcript->move('form/', $official_transcript_name);
               $data->official_transcript = $official_transcript_name;

           }

           if ($request->hasFile('official_exam')) {

               $official_exam = $request->file('official_exam');
               $official_exam_name = $request->input('name_surname') . '-' . 'Exam' . '-' . time() . '-' . uniqid() . '.' . $official_exam->getClientOriginalExtension();
               $official_exam->move('form/', $official_exam_name);
               $data->official_exam = $official_exam_name;

           }

           $query = $data->save();
           if (!$query) {
               return response()->json(['code' => 1, 'success' => 'Your message has been sent successfully']);
           } else {
               return response()->json(['code' => 1, 'success' => 'Your message has been sent successfully']);
           }


       }

   }
}
