<?php

namespace App\Services;

use App\Events\Subscribed;
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

    public function subscribeUser(User $user, string $formationDuration, string $cardNumber, int $expireMonth, int $expireYear, int $cvc, int $amount): Subscription
    {
        return DB::transaction(function () use ($user, $formationDuration, $cardNumber, $expireMonth, $expireYear, $cvc, $amount) {
            $subscription = new Subscription([
                'user_id' => $user->id,
                'formation_duration' => $formationDuration,
                'card_number' => $cardNumber,
            ]);
            $token = $this->stripe->tokens->create([
                'card' => [
                    'number' => $cardNumber,
                    'exp_month' => $expireMonth,
                    'exp_year' => $expireYear,
                    'cvc' => $cvc,
                ]
            ]);

            $charge = $this->stripe->charges->create([
                'amount' => $amount * 100,
                'currency' => 'cad',
                'source' => $token->id,
                'description' => 'Paiement pour le pack #',
            ]);

            event(new Subscribed($subscription, $user));
            return $subscription;
        });
    }
}
