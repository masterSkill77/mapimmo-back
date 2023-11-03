<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    use ValidationErrors;
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
            'card_number' => 'required|int',
            'card_month_expires' => 'required|int',
            'card_year_expires' => 'required|int',
        ];
    }
}
