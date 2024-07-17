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
            'name' => ['required', 'string', 'max:255'],
            'nationality_id' => ['required', 'exists:countries,id'],
            'passport_number' => ['required', 'max:255'],
            'place_of_birth' => ['required', 'max:255'],
            'date_of_birth' => ['required', 'dateFormat:d/m/Y'],
            'passport_photo' => ['nullable','image', 'mimes:jpg,png,jpeg', 'max:2048'],

            'country_id' => ['required', 'exists:countries,id'],
            'email' => ['required', 'email'],

            'school_name' => ['required', 'max:255'],
            'school_country_id' => ['required', 'exists:countries,id'],
            'year_of_graduation' => ['nullable', 'dateFormat:d/m/Y'],
            'high_school_diploma' => ['nullable', 'file', 'mimes:pdf,xlsx,docx,doc', 'max:2048'],
            'official_transcript' => ['nullable', 'file', 'mimes:pdf,xlsx,docx,doc', 'max:2048'],
            'additional_document' => ['nullable', 'file', 'mimes:pdf,xlsx,docx,doc', 'max:2048'],
            'official_exam' => ['nullable', 'file', 'mimes:pdf,xlsx,docx,doc', 'max:2048'],

            'reference' => ['nullable', 'max:255'],
        ];
    }
}
