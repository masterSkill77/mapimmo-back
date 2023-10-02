<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Question\CreateQuestionRequest;
use App\Services\QuestionService;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct(public QuestionService $questionService)
    {
    }
    public function store(CreateQuestionRequest $request) {
        $question = $this->questionService->store($request);

        
    }
}
