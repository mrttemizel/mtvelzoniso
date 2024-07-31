<?php

namespace App\Http\Requests\Agencies;

use App\Models\Agency;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AgencyUpdateRequest extends FormRequest
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
        /** @var Agency $agency */
        $agency = $this->route('agencyId');

        return [
            'agency_name' => ['required', 'string', 'max:255'],
            'agency_email' => ['required', Rule::unique('agencies', 'email')->ignoreModel($agency)],
            'tax_number' => ['required', 'string', 'max:255'],
            'tax_certificate' => ['file', 'mimes:pdf,xlsx,docx,doc', 'max:2048'],
            'contract' => ['file', 'mimes:pdf,xlsx,docx,doc', 'max:2048'],
        ];
    }
}
