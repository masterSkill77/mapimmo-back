<?php

namespace App\Services;

class StripeService
{
    protected $stripe;
    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );
    }
    public function stripe(): \Stripe\StripeClient
    {
        return $this->stripe;
    }
}
