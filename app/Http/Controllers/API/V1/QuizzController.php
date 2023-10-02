<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Quizz\CreateQuizzRequest;
use App\Services\QuizzService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuizzController extends Controller
{
    public function __construct(public QuizzService $quizzService)
    {
    }

    public function storeQuizz(CreateQuizzRequest $request): JsonResponse
    {
        $user = auth()->user();
        $quizz = $this->quizzService->takeQuizz($user, $request->question_id, $request->answer);

        return response()->json($quizz);
    }
}
