<?php

namespace App\Http\Requests\Applications;

use App\Enums\ApplicationStatusEnum;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ApplicationUpdateStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /** @var User $user */
        $user = auth()->user();

        return $user->isAllAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'exists:applications,id'],
            'status' => ['required', new Enum(ApplicationStatusEnum::class)],
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['file', 'mimes:pdf,xlsx,docx,doc', 'max:2048']
        ];
    }
}
