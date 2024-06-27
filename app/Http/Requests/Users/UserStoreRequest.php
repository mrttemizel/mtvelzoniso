<?php

namespace App\Http\Requests\Users;

use App\Enums\UserStatusEnum;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UserStoreRequest extends FormRequest
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
            'role' => ['required', Rule::in(User::getRoles()->keys()->toArray())],
            'agency_id' => ['required_if:role,' . User::ROLE_AGENCY, 'exists:agencies,id'],
            'name' => ['required'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'avatar' => ['image', 'mimes:jpg,jpeg,png,svg', 'max:2048']
        ];
    }
}
