<?php

namespace App\Listeners;

use App\Services\StripeService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class UserSavedListener
{

    protected $stripe;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        $this->stripe = (new StripeService)->stripe();
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $this->stripe->customers->create([
            'description' => 'Customer #' . $event->user->id,
            'email' => $event->user->email,
            'name' => $event->user->name . ' ' . $event->user->lastname
        ]);
    }
}
