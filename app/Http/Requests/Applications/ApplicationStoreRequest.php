<?php

namespace App\Http\Requests\Applications;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
            'passport_photo' => ['required', 'mimes:jpg,png,jpeg,pdf', 'max:2048'],

//            'phone_number' => ['required'],
//            'email' => ['required', 'email'],

            'school_name' => ['required', 'max:255'],
            'school_country_id' => ['required', 'exists:countries,id'],
            'school_diploma' => ['required', 'file', 'mimes:pdf,xlsx,docx,doc', 'max:2048'],
            'official_transcript' => ['required', 'file', 'mimes:pdf,xlsx,docx,doc', 'max:2048'],
            'additional_document' => ['nullable', 'file', 'mimes:pdf,xlsx,docx,doc', 'max:2048'],

            'reference' => ['required', 'max:255'],
            'application_term' => ['required', 'accepted'],
            'gdpr' => ['required', 'accepted']
        ];
    }
}
