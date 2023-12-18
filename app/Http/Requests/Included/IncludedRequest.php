<?php

namespace App\Http\Requests\Included;

use App\Http\Requests\ValidationErrors;
use Illuminate\Foundation\Http\FormRequest;

class IncludedRequest extends FormRequest
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
            'file_name' =>  ['required', 'string',],
            'formation_id' =>  'exists:App\Models\Formation,id'
        ];
    }
}