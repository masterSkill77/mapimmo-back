<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ChapterService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Chapter\CreateChapterRequest;
use App\Models\Chapter;
use App\Services\FormationService;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ChapterController extends Controller
{

    public function __construct(public ChapterService $chapterservice, public FormationService $formationService)
    {
    }
    public function index(): JsonResponse
    {
        $chapters = $this->chapterservice->getAll();
        return response()->json($chapters);
    }

    public function store(CreateChapterRequest $request): JsonResponse
    {
        $data = $request->validated();
        $chapter = $this->chapterservice->store($data);
        return response()->json($chapter, Response::HTTP_CREATED);
    }

    public function updateChapiterInFormation(Request $request): JsonResponse
    {
        $orders = $request->input('orders');
        try {
            // Ici, orders contiennent déjà les chapitres à modifier
            foreach ($orders as $order) {
                $this->chapterservice->update($order, $order['id']);
            }
            return response()->json([
                'message' => 'Chapters updated successfully'
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update(Request $request, $chapterId): JsonResponse
    {
        $chapter = $this->chapterservice->update($request->all(), $chapterId);
        if ($chapter) {
            return response()->json($chapter, 200);
        } else {
            throw new NotFoundHttpException("Erreur de la modification");
        }
    }

    public function getById($chapterId): JsonResponse
    {
        $chapter = $this->chapterservice->chapterGetById($chapterId);
        if(!$chapter) {
            throw new NotFoundHttpException("Chapter `$chapterId` not found");
        }

        return response()->json($chapter);
    }

    public function delete($chapterId): JsonResponse
    {
        $chapter = $this->chapterservice->delete($chapterId);
        if ($chapter) {
            return response()->json($chapter);
        } else {
            throw new NotFoundHttpException("Erreur de la suppresion");
        }
    }
}
