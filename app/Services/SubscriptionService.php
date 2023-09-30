<?php

namespace App\Services;

use App\Events\Subscribed;
use App\Http\Requests\Subscription\CreateSubscriptionRequest;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SubscriptionService
{
    protected $stripe;
    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );
    }

    public function subscribeUser(User $user, CreateSubscriptionRequest $subscriptionRequest) //: Subscription
    {
        return DB::transaction(function () use ($user, $subscriptionRequest) {
            $subscription = new Subscription([
                'user_id' => $user->id,
                'formation_duration' => $subscriptionRequest->formation_duration,
                'plan_id' => $subscriptionRequest->plan_id
            ]);
            $token = $this->stripe->tokens->create([
                'card' => [
                    'number' => $$user->card_number,
                    'exp_month' => $$user->card_month_expires,
                    'exp_year' => $$user->card_year_expires,
                    'cvc' => $subscriptionRequest->cvc,
                ]
            ]);

            $charge = $this->stripe->charges->create([
                'amount' => 500 * 100,
                'currency' => 'cad',
                'source' => $token->id,
                'description' => 'Paiement pour le pack #',
            ]);

            event(new Subscribed($subscription, $user));
            return $subscription;
        });
    }
}
