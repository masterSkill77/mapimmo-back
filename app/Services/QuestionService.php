<?php

namespace App\Services;

use App\Http\Requests\Question\CreateQuestionRequest;
use App\Models\Question;

class QuestionService
{
    public function store(CreateQuestionRequest $request): Question
    {
        $question = new Question($request->toArray());
        $question->save();
        return $question;
    }
}
