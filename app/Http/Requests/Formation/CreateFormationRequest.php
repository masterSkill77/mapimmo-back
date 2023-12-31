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
            'title' =>  ['required', 'string',],
            'duration' => ['required', 'regex:/(\d+\:\d+)/'],
            'description' => ['required', 'string'],
            'target_audience' => ['required', 'string',],
            'to_learn' => ['required', 'string',],
            'prerequisites' => ['required', 'string',],
            'labels' => ['string'],
            'theme' => ['string']
        ];
    }
}
