<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdminService
{
    public function login(LoginRequest $request)
    {
        $email = $request->email;

        $admin = Admin::where('email', $email)->first();
        if (!$admin)
            throw new NotFoundHttpException("Admin with email `$email` not found");
        if (!Hash::check($request->password, $admin->password))
            throw new BadRequestHttpException('Password missmatch');
        $token = $admin->createToken(env('APP_KEY'));

        return ['admin' => $admin, 'token' => $token->plainTextToken];
    }
    public function isAdmin(Admin | User $connected)
    {
        return ($connected instanceof Admin);
    }
}
