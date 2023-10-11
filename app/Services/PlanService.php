<?php

namespace App\Services;

use App\Http\Requests\Plan\CreatePlanRequest;
use App\Models\Plan;
use App\Http\Requests\PayRequest;
use Stripe\Stripe;
use Stripe\PaymentIntent;
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

    public function payPlan(PayRequest $payrequest)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $payment_method = $payrequest->paymentId;
        $amount = $payrequest->amount;
        $currency = $payrequest->currency;
    try{
        $paymentIntent = \Stripe\PaymentIntent::create([
            'payment_method' => $payment_method,
            'amount' => $amount,
            'currency' => 'eur',

        ]);
        return $paymentIntent;
    } catch(\Exception $e){
        return response()->json(['error' => $e->getMessage()], 500);
    }
    }
}
