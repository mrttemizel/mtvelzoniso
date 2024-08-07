<?php

namespace App\Http\Requests\Applications;

use App\Enums\ApplicationStatusEnum;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class ApplicationUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /** @var User $user */
        $user = auth()->user();
        $application = $this->route('applicationId');

        return ! (! $user->isAllAdmin() && $application->status == ApplicationStatusEnum::OFFICIAL_LETTER_SENT->value);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'department_id' => ['required', 'exists:departments,id'],
            'academic_year_id' => ['required', 'exists:academic_years,id'],
            'name' => ['required', 'string', 'max:255'],
            'passport_photo' => ['nullable', 'mimes:jpg,png,jpeg,pdf', 'max:2048'],

//            'phone_number' => ['required'],
//            'email' => ['required', 'email'],

            'school_name' => ['required', 'max:255'],
            'school_country_id' => ['required', 'exists:countries,id'],
            'school_diploma' => ['nullable', 'file', 'mimes:pdf,xlsx,docx,doc,jpeg,jpg,png', 'max:2048'],
            'official_transcript' => ['nullable', 'file', 'mimes:pdf,xlsx,docx,doc,jpeg,jpg,png', 'max:2048'],
            'additional_document' => ['nullable', 'file', 'mimes:pdf,xlsx,docx,doc', 'max:2048'],

            'reference' => ['required', 'max:255'],
        ];
    }
}
