<?php

namespace App\Services;

use App\Http\Requests\Plan\CreatePlanRequest;
use App\Models\Plan;
use App\Http\Requests\PayRequest;
use Stripe\Customer;
use Stripe\Stripe;
use Stripe\PaymentIntent;

use function Laravel\Prompts\confirm;

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
    try{
        $customer = Customer::create([
            'email' => $payrequest->email,
            'name' => $payrequest->name,
            'phone' => $payrequest->phone,

        ]);

        $paymentIntent = \Stripe\PaymentIntent::create([
            'payment_method' => $payment_method,
            'amount' => $amount* 100,
            'currency' => 'EUR',
            'description' => 'Paiement de la formation',
            'metadata' => [
                'email' => $payrequest->email,
                'phone' => $payrequest->phone,
                'name' => $payrequest->name
            ],
            'customer' => $customer->id,

        ]);
            return $paymentIntent;

    } catch(\Exception $e){
        return response()->json(['error' => $e->getMessage()], 500);
    }
    }
}


