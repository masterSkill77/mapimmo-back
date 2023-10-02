<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ChapterService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Chapter\CreateChapterRequest;
use Symfony\Component\HttpFoundation\Response;

class ChapterController extends Controller
{

    public function __construct(public ChapterService $chapterservice)
    {

    }
    public function index(): JsonResponse
    {
        $chapters = $this->chapterservice->getAll();
        return response()->json($chapters);
    }

    public function store(CreateChapterRequest $request ): JsonResponse
    {
        $data = $request->validated();
        $chapter = $this->chapterservice->store($data);
        return response()->json($chapter, Response::HTTP_CREATED);
    }


}
