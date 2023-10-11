<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Plan\CreatePlanRequest;
use App\Services\PlanService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PayRequest;
use Barryvdh\DomPDF\Facade\Pdf;
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

    public function generateInvoice(Request $request)
    {
            $data = $request->all();
            $pdf = PDF::loadView('invoice',['data'=>$data]);

        return $pdf->download('invoice.pdf');
    }
}
