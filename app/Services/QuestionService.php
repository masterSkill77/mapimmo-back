<?php

namespace App\Services;

use App\Http\Requests\Question\CreateQuestionRequest;
use App\Models\Question;

class QuestionService
{
    public function __construct(public FormationService $formationService)
    {
    }
    public function store(CreateQuestionRequest $request, string $foramtionUuid): Question | null
    {
        $formation = $this->formationService->getByUuid($foramtionUuid);
        if (!$formation)
            return null;

        $question = new Question($request->toArray());
        $question->formation_id = $formation->id;
        $question->save();
        return $question;
    }

    public function getAllQuestion()
    {
        return Question::all();
    }

    public function update(array $data, int $questionId): Question
    {
        $question = Question::find($questionId);

        if (!$question) {
            return null; 
        }
        $question->fill($data);
        $question->save();
    
        return $question;
    }

    public function delete($questionId): string
    {
        return Question::where('id', $questionId)->delete();
    }

    public function getById(int $questionId): ?Question
    {
        return Question::find($questionId);
    }
}
