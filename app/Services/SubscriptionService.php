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
        $this->stripe = (new StripeService)->stripe();
    }

    public function subscribeUser(User $user, CreateSubscriptionRequest $subscriptionRequest) //: Subscription
    {
        return DB::transaction(function () use ($user, $subscriptionRequest) {
            $subscription = new Subscription([
                'user_id' => $user->id,
                'formation_duration' => $subscriptionRequest->formation_duration,
                'plan_id' => $subscriptionRequest->plan_id
            ]);
            // cus_OjYWMPkTPu6xxT

            // $token = $this->stripe->tokens->create([
            //     'card' => [
            //         'number' => $user->card_number,
            //         'exp_month' => $user->card_month_expires,
            //         'exp_year' => $user->card_year_expires,
            //         'cvc' => $subscriptionRequest->cvc,
            //     ]
            // ]);


            $customer = $this->stripe->customers->create([
                'description' => 'Custtomer #' . $user->id,
                'email' => 'clairmont@saha-technology.com'
            ]);

            // $this->stripe->charges->create([
            //     'amount' => 500 * 100,
            //     'currency' => 'cad',
            //     'customer' => 'cus_OjYWMPkTPu6xxT',
            //     'source' => 'card_1Nw5QkKJGrbbmbLKaW8uaLCh',
            //     'description' => 'Paiement pour le pack #',
            // ]);

            // event(new Subscribed($subscription, $user));
            return $customer;
        });
    }
}
