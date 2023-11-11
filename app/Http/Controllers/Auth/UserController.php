<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
    public function update(Request $request, int $userId) :JsonResponse{

        $this->validate($request, [
            'email' => 'email',
        ]);

        $data = $request->all();

        $user = $this->userService->update($data, $userId);

        return response()->json($user);
    }

    public function getById($userId)
    {
        $user = $this->userService->getById($userId);
        if(!$user) {
            throw new NotFoundHttpException("utilisateur `$userId` not found");
        }

        return response()->json($user);
    }

    public function updateUserPhoto(Request $request) {
        $user = auth()->user();
        $path = $request->file('photo');

        $user = $this->userService->updateUserPhoto($user, $path);

        return response()->json($user);
    }
}
