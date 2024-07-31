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
            'name' => ['required', 'string', 'max:255'],
            'nationality_id' => ['required', 'exists:countries,id'],
            'passport_number' => ['required', 'max:255'],
            'place_of_birth' => ['required', 'max:255'],
            'date_of_birth' => ['required','dateFormat:d/m/Y'],
            'passport_photo' => ['required','image', 'mimes:jpg,png,jpeg', 'max:2048'],

            'country_id' => ['required', 'exists:countries,id'],
//            'email' => ['required', 'email'],

            'school_name' => ['required', 'max:255'],
            'school_country_id' => ['required', 'exists:countries,id'],
            'year_of_graduation' => ['nullable', 'dateFormat:d/m/Y'],
            'high_school_diploma' => ['nullable', 'file', 'mimes:pdf,xlsx,docx,doc', 'max:2048'],
            'official_transcript' => ['nullable', 'file', 'mimes:pdf,xlsx,docx,doc', 'max:2048'],
            'additional_document' => ['nullable', 'file', 'mimes:pdf,xlsx,docx,doc', 'max:2048'],
            'official_exam' => ['nullable', 'file', 'mimes:pdf,xlsx,docx,doc', 'max:2048'],

            'reference' => ['nullable', 'max:255'],
            'application_term' => ['required', 'accepted'],
            'gdpr' => ['required', 'accepted']
        ];
    }
}
