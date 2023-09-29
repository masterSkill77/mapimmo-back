<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Formation\CreateFormationRequest;
use App\Services\FormationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FormationController extends Controller
{
    public function __construct(public FormationService $formationService)
    {
    }
    public function getFormation(int $formationId): JsonResponse
    {
        $formation = $this->formationService->getById($formationId);
        if (!$formation)
            throw new NotFoundHttpException("Formation with `$formationId` not found");
        return response()->json($formation);
    }
    public function index(): JsonResponse
    {
        $formations = $this->formationService->getAll();
        return response()->json($formations);
    }

    public function store(CreateFormationRequest $request)
    {
    }
}
