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
}
