<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Plan\CreatePlanRequest;
use App\Services\PlanService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function __construct(public PlanService $planService)
    {
    }
    public function store(CreatePlanRequest $createPlanRequest): JsonResponse
    {
        $plan = $this->planService->store($createPlanRequest);
        return response()->json($plan);
    }
    public function index(): JsonResponse
    {
        $plans = $this->planService->getAllPlan();
        return response()->json($plans);
    }
}
