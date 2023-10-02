<?php

namespace App\Services;

use App\Models\Question;
use App\Models\Quizz;
use App\Models\User;

class QuizzService
{
    public function takeQuizz(User $user, int $questionId, string $answer)
    {
        $quizz = new Quizz([
            'user_id' => $user->id,
            'question_id' => $questionId,
            'answer' => $answer,
        ]);

        $quizz->save();
        return $quizz;
    }
}
