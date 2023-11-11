<?php

namespace App\Services;

use App\Events\UserCreated;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

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
        event(new UserCreated($user));
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

    public function update(array $data, int $userId) : User
    {
        $user = User::find($userId);

        if (!$user) {
            throw new NotFoundHttpException("User not found");
        }

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->fill($data);
        $user->save();

        return $user;
    }

    public function updateUserPhoto(User $user, $path) {
        $user->photo = $path;
        $user->save();
        return $user;
    }

    public function getAllUser()
    {
        return User::with('formations.formation')->get();
    }

    public function getById(int $userId): User
    {
        return User::with('formations.formation')->find($userId);
    }
}
