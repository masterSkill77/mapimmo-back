<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserService
{
    public function register(RegisterRequest $request): User
    {
        $data = $request->toArray();
        $data['password'] = Hash::make($data['password']);
        $user = new User($data);
        $user->save();
        return $user;
    }
    public function login(LoginRequest $request): array
    {
        $email = $request->email;

        $user = User::where('email', $email)->first();
        if (!$user)
            throw new NotFoundHttpException("User with email `$email` not found");
        if (!Hash::check($request->password, $user->password))
            throw new BadRequestHttpException('Password missmatch');
        $token = $user->createToken(env('APP_KEY'));

        return ['user' => $user, 'token' => $token->plainTextToken];
    }

    public function update(UserUpdateRequest $request) : User
    {
        $user = auth()->user();
        if($user){
           $data = $request->toArray();
           $data['password'] = Hash::make($data['password']);
           $user = new User($data);
           $user->save();
           return $user;
        }
        throw new NotFoundHttpException("User  not found");
    }
}