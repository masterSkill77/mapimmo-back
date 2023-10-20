<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subscription\CreateSubscriptionRequest;
use App\Services\SubscriptionService;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function __construct(public SubscriptionService $subscriptionService)
    {
    }
    public function subscribeToModule(CreateSubscriptionRequest $createSubscriptionRequest)
    {
        $user = auth()->user();
        $subscription = $this->subscriptionService->subscribeUser($user, $createSubscriptionRequest);
        return response()->json($subscription);
    }
}
