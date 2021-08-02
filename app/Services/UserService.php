<?php

namespace App\Services;

use App\Entities\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * login
     *
     * @param \App\Http\Requests\LoginRequest $request 
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $token = auth('api')->attempt([
            'email'     => $request->email,
            'password'  => $request->password
        ]);

        if ($token) {
            return response()->json(['token' => $token]);
        }

        return response()->json(['error' => 'Usuário ou senha inválido'], 403);
    }

    /**
     * login
     *
     * @param \App\Http\Requests\RegisterRequest $request 
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->userRepository->create([
            "name"  => $request->name,
            "email" => $request->email,
            "password"  => Hash::make($request->password),
        ]);

        return response()->json($user, 200);
    }
}
