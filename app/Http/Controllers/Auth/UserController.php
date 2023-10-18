<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(public UserService $userService)
    {
    }

    public function index(): JsonResponse
    {
        $user = $this->userService->getAllUser();
        return response()->json($user);
    }
    public function update(RegisterRequest $request) :JsonResponse{
    
       $user = $this->userService->update($request);
       return response()->json($user);
    }

}
