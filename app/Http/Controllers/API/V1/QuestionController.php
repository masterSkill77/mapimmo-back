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

    public function index()
    {
        $question = $this->questionService->getAllQuestion();

        return response()->json($question);
    }

    public function getById($questionId): JsonResponse
    {
        $question = $this->questionService->getById($questionId);
        if(!$question) {
            throw new NotFoundHttpException("Qestion `$questionId` not found");
        }

        return response()->json($question);
    }

    public function update(Request $request, $questionId): JsonResponse
    {
        $question = $this->questionService->update($request->all(), $questionId);
        if ($question) {
            return response()->json($question, 200);
        } else {
            throw new NotFoundHttpException("Erreur de la modification");
        }
    }

    public function delete($questionId): JsonResponse
    {
        $question = $this->questionService->delete($questionId);
        if ($question) {
            return response()->json($question);
        } else {
            throw new NotFoundHttpException("Erreur de la suppresion");
        }
    }
}
