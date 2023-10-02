<?php

namespace App\Services;

use App\Events\Subscribed;
use App\Http\Requests\Subscription\CreateSubscriptionRequest;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\PlanSubscription;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SubscriptionService
{
    protected $stripe;
    public function __construct()
    {
        $this->stripe = (new StripeService)->stripe();
    }

    public function subscribeUser(User $user, CreateSubscriptionRequest $subscriptionRequest) //: Subscription
    {
        return DB::transaction(function () use ($user, $subscriptionRequest) {
            $plan = Plan::where('id', $subscriptionRequest->plan_id)->first();
            $subscription = new Subscription([
                'user_id' => $user->id,
                'active' => true,
                'is_paid' => true
            ]);
            $subscription->save();
            foreach ($subscriptionRequest->plan_subscription as $subscription_plan) {
                PlanSubscription::create([
                    'plan_id' => $subscription_plan['plan_id'],
                    'subscription_id' => $subscription->id,
                    'quantity' => $subscription_plan['quantity']
                ]);
            }

            // $customer = $this->stripe->customers->search([
            //     // 'query' => "email: '$user->email'"
            //     // ACTIVATE THIS PART IF FRONTEND IS OK
            //     'query' => "email : 'contact@mapim-formation.com'"
            // ])->data[0];
            // $paymentMethod = $this->stripe->customers->allPaymentMethods(
            //     $customer->id,
            //     ['type' => 'card']
            // )->data[0];
            // $charge = $this->stripe->charges->create([
            //     'amount' => $plan->price * 100,
            //     'currency' => 'eur',
            //     'customer' => $customer->id,
            //     'source' => $paymentMethod->id,
            //     'description' => 'Subscription creation',
            // ]);

            // event(new Subscribed($subscription, $user));
            return $subscription;
        });
    }
}
