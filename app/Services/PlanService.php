<?php

namespace App\Services;

use App\Http\Requests\Plan\CreatePlanRequest;
use App\Models\Plan;

class PlanService
{
    public function store(CreatePlanRequest $createPlanRequest)
    {
        $plan = new Plan($createPlanRequest->toArray());
        $plan->save();
        return $plan;
    }
    public function getAllPlan()
    {
        return Plan::all();
    }
}
