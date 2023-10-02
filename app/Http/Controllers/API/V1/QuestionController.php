<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Question\CreateQuestionRequest;
use App\Services\QuestionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class QuestionController extends Controller
{
    public function __construct(public QuestionService $questionService)
    {
    }
    public function store(CreateQuestionRequest $request, string $uuid): JsonResponse
    {
        $question = $this->questionService->store($request, $uuid);
        if (!$question)
            throw new NotFoundHttpException("Fomration with UUID `$uuid` not found");
        return response()->json($question);
    }
}
