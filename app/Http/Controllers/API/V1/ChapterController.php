<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ChapterService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Chapter\CreateChapterRequest;
use App\Models\Chapter;
use App\Services\FormationService;
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

    public function store(CreateChapterRequest $request ): JsonResponse
    {
        $data = $request->validated();
        $chapter = $this->chapterservice->store($data);
        return response()->json($chapter, Response::HTTP_CREATED);
    }

    public function updateChapiterInFormation(Request $request): JsonResponse
    {
        $orders = $request->input('orders');

        // Créez un tableau associatif pour stocker la somme des ordres par formationId
        $orderSumByFormation = [];
    
        foreach ($orders as $order) {
            $formationId = $order['formationId'];
            $newOrder = $order['order'];
    
            if (!isset($orderSumByFormation[$formationId])) {
                $orderSumByFormation[$formationId] = 0;
            }
    
            // Ajoutez la valeur d'ordre à la somme existante
            $orderSumByFormation[$formationId] += $newOrder;
        }
    
        // Parcourez le tableau orderSumByFormation et mettez à jour les chapitres
        foreach ($orderSumByFormation as $formationId => $totalOrder) {
            $chapters = Chapter::where('formation_id', $formationId)->get();
    
            if ($chapters->isEmpty()) {
                throw new NotFoundHttpException("No chapters found for Formation ID $formationId");
            }
    
            foreach ($chapters as $chapter) {
                $chapter->order = $totalOrder;
                $chapter->save();
            }
        }
    
        return response()->json([
            'message' => 'Chapters updated successfully'
        ]);
    }
}
