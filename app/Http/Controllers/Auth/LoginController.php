<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(public UserService $userService)
    {
    }
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $result = $this->userService->login($request);
        return response()->json($result);
    }
}
