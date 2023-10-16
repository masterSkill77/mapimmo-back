<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Plan\CreatePlanRequest;
use App\Services\PlanService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PayRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
    public function pay(PayRequest $payrequest) 
    {
        $plan = $this->planService->payPlan($payrequest);
        return response()->json($plan);
    }

    public function update(Request $request, $planId): JsonResponse
    {
        $plan = $this->planService->update($request->all(), $planId);
        if ($plan) {
            return response()->json($plan, 200);
        } else {
            throw new NotFoundHttpException("Erreur de la modification");
        }
    }

    public function getById($planId): JsonResponse
    {
        $plan = $this->planService->getById($planId);
        if(!$plan) {
            throw new NotFoundHttpException("plan `$planId` not found");
        }

        return response()->json($plan);
    }

    public function delete($planId): JsonResponse
    {
        $plan = $this->planService->delete($planId);
        if ($plan) {
            return response()->json($plan);
        } else {
            throw new NotFoundHttpException("Erreur de la suppresion");
        }
    }

}
