<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function __construct(public UserService $userService)
    {
    }
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $user = $this->userService->register($request);
        return response()->json($user);
    }
}
