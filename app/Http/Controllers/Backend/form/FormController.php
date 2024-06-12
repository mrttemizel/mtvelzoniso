<?php

namespace App\Http\Controllers\backend\form;

use App\Http\Controllers\Controller;
use App\Mail\FormStoreAdminInformation;
use App\Mail\FormStoreMail;
use App\Mail\SendPreLatter;
use App\Models\Form;
use App\Models\Letter;
use App\Models\Section;
use App\Models\User;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{

    public function NotificationMessage($message, $alertType)
    {
        $notification = array(
            'message' => $message,
            'alert-type' => $alertType
        );
        return $notification;
    }

    public function index()
    {


        if (Auth::user()->status == 0 | Auth::user()->status == 1 | Auth::user()->status == 2) {
            $data = Form::all();
            return view('backend.form.index', compact('data'));
        } elseif (Auth::user()->status == 3) {
            $data = Form::all()->where('user_id', Auth::user()->id);
            return view('backend.form.index', compact('data'));
        } elseif (Auth::user()->status == 4) {
            $data = Form::all()->where('user_id', Auth::user()->id);
            return view('backend.form.index', compact('data'));
        } else {
            $data = Form::all();
            return view('backend.form.index', compact('data'));
        }
    }

    public function see($id)
    {

        $data = Form::where('id', $id)->first();
        return view('backend.form.form-details-modal', compact('data')); // Modal içeriği olarak veriyi döndür
    }

    public function create()
    {

        if (Auth::user()->status == 3) {
            $existingRecord = Form::where('user_id', Auth::user()->id)->exists();
            if ($existingRecord) {
                return back()->with($this->NotificationMessage('A prior application for this student has already been submitted.', 'error'));
            } else {
                $data = Section::query()
                    ->orderBy('section_name', 'asc')
                    ->get();

                return view('backend.form.create', compact('data'));
            }
        }
        $data = Section::query()
            ->orderBy('section_name', 'asc')
            ->get();
        return view('backend.form.create', compact('data'));


    }

    public function store(Request $request)
    {

        $request->validate([
            'name_surname' => 'required',
            'nationality' => 'required',
            'passport_no' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required|date',
            'country' => 'required',
            'adress' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'high_school' => 'required',
            'high_school_country' => 'required',
            'high_school_city' => 'required',
            'year_of_graduation' => 'required|date',
            'graduation_degree' => 'required',
            'section_id' => 'required',

            'passport_photo' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'official_transcript' => 'required|file|mimes:pdf,xlsx,docx,doc|max:2048',
            'official_exam' => 'file|mimes:pdf,xlsx,docx,doc|max:2048',

            'checkbox_kvkk' => 'required',
            'checkbox_application_status' => 'required',
        ]);

        $basvuru_id = IdGenerator::generate(['table' => 'forms', 'field' => 'basvuru_id', 'length' => 10, 'prefix' => 'ABU-']);
        $data = new Form();

        $data->basvuru_id = $basvuru_id;

        $data->name_surname = $request->input('name_surname');
        $data->user_id = Auth::user()->id;
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
        $data->about_us = $request->input('about_us');
        $data->application_status = 1;

        if (Auth::user()->status == 4) {
            $data->agency_code = Auth::user()->agency_code;
        }


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

        $mail = [
            'title' => 'Greetings from Antalya Bilim University!',
            'body1' => 'We are delighted to inform you that we have received your application and it is currently under evaluation. ',
            'body2' => 'You can expect to receive an update on the status of your application within the next 3 working days. In the meantime, if you have any questions or require further assistance, feel free to reach out to us.',
            'body3' => 'Best Regards,',
        ];

        $mailAdmin = [
            'title' => 'Yeni Başvuru Alınmıştır :',
            'tableData' => [
                ['key' => 'Ad Soyad', 'value' => $request->input('name_surname')],
                ['key' => 'E-Posta', 'value' => $request->input('email')],
                ['key' => 'Application ID', 'value' => $basvuru_id],
            ]
        ];
        Mail::to(Auth::user()->email)->send(new FormStoreMail($mail));
        Mail::to('murat.temizel@antalya.edu.tr')->send(new FormStoreAdminInformation($mailAdmin));
        $query = $data->save();
        if (!$query) {
            return back()->with($this->NotificationMessage('Application Process Wrong', 'error'));
        } else {
            return redirect()->route('form.index')->with($this->NotificationMessage('Application Process Successful', 'success'));
        }
    }

    public function edit($id)
    {
        $section = Section::orderBy('section_name', 'asc')->get();
        $data = Form::findOrFail($id);
        return view('backend.form.edit', compact('data', 'section'));

    }

    public function update(Request $request)
    {

        $data = Form::where('id', $request->id)->first();

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
        $data->about_us = $request->input('about_us');

        if ($request->hasFile('passport_photo')) {
            $request->validate([
                'passport_photo' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            ]);

            $path = public_path() . '/form/' . $data->passport_photo;

            if (\File::exists($path)) {
                \File::delete($path);
            }
            $passport_photo = $request->file('passport_photo');
            $passport_photo_name = $request->input('name_surname') . '-' . 'Passport' . '-' . time() . '-' . uniqid() . '.' . $passport_photo->getClientOriginalExtension();
            $passport_photo->move('form/', $passport_photo_name);
            $data->passport_photo = $passport_photo_name;

        }
        if ($request->hasFile('official_transcript')) {
            $request->validate([
                'official_transcript' => 'required|file|mimes:pdf,xlsx,docx,doc|max:2048',
            ]);

            $path1 = public_path() . '/form/' . $data->official_transcript;

            if (\File::exists($path1)) {
                \File::delete($path1);
            }
            $official_transcript = $request->file('official_transcript');
            $official_transcript_name = $request->input('name_surname') . '-' . 'Transcript' . '-' . time() . '-' . uniqid() . '.' . $official_transcript->getClientOriginalExtension();
            $official_transcript->move('form/', $official_transcript_name);
            $data->official_transcript = $official_transcript_name;

        }
        if ($request->hasFile('official_exam')) {
            $request->validate([
                'official_exam' => 'file|mimes:pdf,xlsx,docx,doc|max:2048',
            ]);

            $path2 = public_path() . '/form/' . $data->official_exam;

            if (\File::exists($path2)) {
                \File::delete($path2);
            }
            $official_exam = $request->file('official_exam');
            $official_exam_name = $request->input('name_surname') . '-' . 'Exam' . '-' . time() . '-' . uniqid() . '.' . $official_exam->getClientOriginalExtension();
            $official_exam->move('form/', $official_exam_name);
            $data->official_exam = $official_exam_name;

        }

        $query = $data->update();

        if (!$query) {
            return redirect()->route('form.index')->with($this->NotificationMessage('Dosya Düzenleme İşlemi Başarısız', 'error'));
        } else {
            return redirect()->route('form.index')->with($this->NotificationMessage('Başvuru Düzenleme İşlemi Başarılı', 'success'));
        }
    }

    public function delete($id)
    {
        $data = Form::find($id);

        $path = public_path() . '/form/' . $data->passport_photo;

        if (\File::exists($path)) {
            \File::delete($path);
        }

        $path1 = public_path() . '/form/' . $data->official_transcript;

        if (\File::exists($path1)) {
            \File::delete($path1);
        }

        $path2 = public_path() . '/form/' . $data->official_exam;

        if (\File::exists($path2)) {
            \File::delete($path2);
        }
        $query = $data->delete();
        if (!$query) {
            return back()->with('error', 'Kullanıcı düzenlerken bir hata oluştu!');
        } else {
            return back()->with($this->NotificationMessage('Başvuru Silme İşlemi Başarılı', 'success'));
        }
    }


    public function send_pre_letter(Request $request)
    {
        $form = Form::where('basvuru_id', $request->input('basvuru_id'))->first();

        $user_id = $form->user_id;

        $form->application_status = 2;

        $name = (Form::where('basvuru_id', $request->input('basvuru_id'))->first())->name_surname;

        $mail_adress = User::where('id', $user_id)->first()->email;

        $request->validate([
            'preliminary_acceptance_letter' => 'required|file|mimes:pdf,xlsx,docx,doc|max:2048',
        ]);

        if ($request->hasFile('preliminary_acceptance_letter')) {

            $preliminary_acceptance_letter = $request->file('preliminary_acceptance_letter');
            $preliminary_acceptance_letter_name = $name . '-' . 'Preliminary Acceptance Letter' . '-' . time() . '.' . $preliminary_acceptance_letter->getClientOriginalExtension();
            $preliminary_acceptance_letter->move('pre-letter/', $preliminary_acceptance_letter_name);
            $form->preliminary_acceptance_letter = $preliminary_acceptance_letter_name;
        }

        $file_path = asset('/pre-letter/' . $preliminary_acceptance_letter_name);

        $query = $form->update();
        $mail = [
            'title' => 'Greetings from Antalya Bilim University!',
            'body1' => $file_path,
        ];

        Mail::to($mail_adress)->send(new SendPreLatter($mail));

        if (!$query) {
            return back()->with($this->NotificationMessage('Application Process Wrong', 'error'));
        } else {
            return redirect()->route('auth.index')->with($this->NotificationMessage('Kabul Mektubu Gönderildi', 'success'));
        }
    }

}
