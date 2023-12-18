<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Included\IncludedRequest;
use App\Services\IncludedService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IncludedController extends Controller
{

    public function __construct (public IncludedService $includedService)
    {
    
    }

    public function  index(): JsonResponse
    {
        $uncluded = $this->includedService->getAll();
        return response()->json($uncluded);
    }

    public function store(IncludedRequest $request) : JsonResponse
    {
        $data = $request->validated();
        $included = $this->includedService->store($data);
        return response()->json($included);
    }

    public function getById(int $included): JsonResponse
    {
        $included = $this->includedService->getById($included);
        if (!$included)
            throw new NotFoundHttpException("included not found with `$included`");
        return response()->json($included);
    }

    public function update(Request $request, $included): JsonResponse
    {
        $included = $this->includedService->update($request->all(), $included);
        if ($included) {
            return response()->json($included, 200);
        } else {
            throw new NotFoundHttpException("Erreur de la modification");
        }
    }

    public function delete($includedId): JsonResponse
    {
        $included = $this->includedService->delete($includedId);
        if ($included) {
            return response()->json($included);
        } else {
            throw new NotFoundHttpException("Erreur de la suppresion");
        }
    }

}