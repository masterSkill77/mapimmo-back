<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'bail|required|string',
            'email' => 'required|email|string|unique:users',
            'password' => 'required|string',
            'enterprise_name' => 'required|string',
            'lastname' => 'required|string',
            'phone_number' => 'required|string',
            'card_number' => 'required|string',
            'card_month_expires' => 'required|integer',
            'card_year_expires' => 'required|integer',
        ];
    }
}
