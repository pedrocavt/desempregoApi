<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;

class UserService
{

    /**
     * login
     *
     * @param \App\Http\Requests\LoginRequest $request 
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $token = auth('api')->attempt($request->all());

        if ($token) {
            return response()->json(['token' => $token]);
        }

        return response()->json(['error' => 'Usuário ou senha inválido'], 403);
    }
}
