<?php

namespace App\Http\Requests\Quizz;

use App\Http\Requests\ValidationErrors;
use Illuminate\Foundation\Http\FormRequest;

class CreateQuizzRequest extends FormRequest
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
            'quizz' => 'array|required',
            'quizz.*' => 'array|required',
            'quizz.*.question_id' => 'required|int',
            'quizz.*.answer' => 'string|required'
        ];
    }
}
