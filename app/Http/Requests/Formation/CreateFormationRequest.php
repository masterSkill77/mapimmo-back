<?php

namespace App\Http\Requests\Formation;

use App\Http\Requests\ValidationErrors;
use Illuminate\Foundation\Http\FormRequest;

class CreateFormationRequest extends FormRequest
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
            'title' =>  ['required', 'string', 'max:100'],
            'duration'=> ['required', 'regex:/(\d+\:\d+)/'],
            'description'=> ['required', 'string', 'max:255'],
            'target_audience'=> ['required', 'string', 'max:100'],
            'to_learn'=> ['required', 'string','max:100'],
            'prerequisites'=> ['required', 'string','max:100'],
            'included'=> ['required'],
        ];
    }
}
