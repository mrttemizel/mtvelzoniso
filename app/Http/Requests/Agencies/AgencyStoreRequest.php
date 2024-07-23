<?php

namespace App\Http\Requests\Agencies;

use Illuminate\Foundation\Http\FormRequest;

class AgencyStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->isAllAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'agency_name' => ['required', 'string', 'max:255'],
            'tax_number' => ['required', 'string', 'max:255'],
            'tax_certificate' => ['file', 'mimes:pdf,xlsx,docx,doc', 'max:2048'],
            'contract' => ['file', 'mimes:pdf,xlsx,docx,doc', 'max:2048'],

            'username' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'email', 'max:255', 'unique:agencies,email'],
//            'phone' => ['required', 'string', 'max:255'],
        ];
    }
}
