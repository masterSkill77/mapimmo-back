<?php

namespace App\Http\Requests\Question;

use App\Http\Requests\ValidationErrors;
use Illuminate\Foundation\Http\FormRequest;

class CreateQuestionRequest extends FormRequest
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
            'question_title' => 'string|required',
            'question_type' => 'int|required',
            'question_order' => 'int|required',
            'answers' => 'string|required',
            'correct_answer' => 'string|required',
        ];
    }
}
