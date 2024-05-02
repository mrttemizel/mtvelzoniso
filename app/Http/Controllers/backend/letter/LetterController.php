<?php

namespace App\Http\Controllers\backend\letter;

use App\Http\Controllers\Controller;
use App\Mail\SendPreLatter;
use App\Models\Form;
use App\Models\Letter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LetterController extends Controller
{
    public function NotificationMessage($message, $alertType) {
        $notification = array(
            'message' => $message,
            'alert-type' => $alertType
        );
        return $notification;
    }
    public  function send_pre_letter(Request $request)
    {
        $form = Form::where('basvuru_id',$request->input('basvuru_id'))->first();
        $user_id = $form->user_id;
        $form -> application_status = 2;
        $form->update();
        $name = (Form::where('basvuru_id',$request->input('basvuru_id'))->first())->name_surname;

        $mail_adress = User::where('id', $user_id)->first()->email;

        $data = new Letter();

        $request->validate([
            'preliminary_acceptance_letter' => 'required|file|mimes:pdf,xlsx,docx,doc|max:2048',
        ]);

        if ($request->hasFile('preliminary_acceptance_letter')) {

            $preliminary_acceptance_letter = $request->file('preliminary_acceptance_letter');
            $preliminary_acceptance_letter_name =$name .'-'. 'Preliminary Acceptance Letter' . '-' .  time() . '.' . $preliminary_acceptance_letter->getClientOriginalExtension();
            $preliminary_acceptance_letter->move('pre-letter/', $preliminary_acceptance_letter_name);
            $data->preliminary_acceptance_letter = $preliminary_acceptance_letter_name;
        }

        $file_path = asset('/pre-letter/' . $preliminary_acceptance_letter_name);

        $query = $data->save();
        $mail = [
            'title' => 'Greetings from Antalya Bilim University!',
            'body1' => $file_path,
        ];

        Mail::to($mail_adress)->send(new SendPreLatter($mail));

        if (!$query) {
            return back()->with($this->NotificationMessage('Application Process Wrong','error'));
        } else {
            return redirect()->route('form.index')->with($this->NotificationMessage('Kabul Mektubu Gönderildi','success'));
        }
    }
}
