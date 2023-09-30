<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name'    => ['string', 'max:255'],
            'email'   => ['email','email', 'unique:users'],
            'lastname' => ['string', 'max:255'],
            'enterprise_name' => 'required',
            'phone_number' =>['required', 'max:12']
            
        ];
    }
}
