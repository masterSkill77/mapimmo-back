<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(public UserService $userService){}

    public function updateUserPhoto(Request $request) {
        $user = auth()->user();
        $path = $request->file('photo');

        $user = $this->userService->updateUserPhoto($user, $path);

        return response()->json($user);
    }
}
