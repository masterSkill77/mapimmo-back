<?php

namespace App\Services;

use App\Models\Question;
use App\Models\Quizz;
use App\Models\User;

class QuizzService
{
    public function takeQuizz(User $user, int $questionId, string $answer)
    {
        $question = Question::where('id', $questionId)->first();
        $validated = false;
        if ($question->question_type == Question::TRUE_OR_FALSE)
            if ($answer == $question->correct_answer)
                $validated = true;
            else {
                $correctAnswer = array_diff_assoc(explode('|', $answer), explode('|', $question->correct_answer));
                if (count($correctAnswer) == 0)
                    $validated = true;
            }

        $quizz = Quizz::updateOrCreate([
            'user_id' => $user->id,
            'question_id' => $questionId,
            'answer' => $answer,
            'validated' => $validated
        ]);

        $quizz->save();
        return $quizz;
    }

    public function getQuizzForUser(int $userId)
    {
        $myQuizzes = Quizz::where('user_id', $userId)->with('question', 'question.formation')->get();
        return $myQuizzes;
    }
}
