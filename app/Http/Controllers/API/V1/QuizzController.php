<?php

namespace App\Http\Controllers\API\V1;

use App\Events\FormationValidated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Quizz\CreateQuizzRequest;
use App\Services\QuizzService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuizzController extends Controller
{
    public function __construct(public QuizzService $quizzService)
    {
    }

    public function storeQuizz(CreateQuizzRequest $request): JsonResponse
    {
        $user = auth()->user();
        $quizzs = [];
        foreach ($request->quizz as $quizz) {
            $quizzs[] = $this->quizzService->takeQuizz($user, $quizz['question_id'], $quizz['answer']);
        }
        $validatedQuestion = array_filter($quizzs, fn ($quizz) => ($quizz->validated));
        // $allValidated = count($notValidatedQuestion) == 0;



        if ((count($validatedQuestion) / count($quizzs) >= 0.6)) {
            event(new FormationValidated($request->quizz, $user));
        }
        return response()->json($quizzs, Response::HTTP_CREATED);
    }
    public function getMyQuizz()
    {
        $user = auth()->user();
        $myQuizzes = $this->quizzService->getQuizzForUser($user->id);

        return response()->json($myQuizzes);
    }

    public function getListQuizzes() {
        $quizzes = $this->quizzService->getListQuizz();

        return response()->json($quizzes);
    }
}
