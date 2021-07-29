<?php

namespace App\Services;

use App\Entities\User;
use App\Repositories\UserRepository;

class UserService
{
    public function login($request)
    {
        $token = auth('api')->attempt($request->all());

        if ($token) {
            return response()->json(['token' => $token]);
        }

        return response()->json(['error' => 'Usuário ou senha inválido'], 403);
    }
}
