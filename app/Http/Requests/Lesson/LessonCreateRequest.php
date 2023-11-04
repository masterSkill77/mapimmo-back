<?php

namespace App\Http\Requests\Lesson;

use App\Http\Requests\ValidationErrors;
use Illuminate\Foundation\Http\FormRequest;

class LessonCreateRequest extends FormRequest
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
            'lesson_title' => ['required', 'string'],
            'youtube_video' => ['nullable', 'string'],
            'order' => ['required', 'int'],
            'chapter_id' =>  'exists:App\Models\Chapter,id'
        ];
    }
}
