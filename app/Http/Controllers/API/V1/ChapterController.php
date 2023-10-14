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
}
