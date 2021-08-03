<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use App\Entities\User;
use Exception;

class UserService
{
    private $userRepository;

    /**
     * construct
     *
     * @param \App\Repositories\UserRepository $userRepository 
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * login
     *
     * @param \App\Http\Requests\LoginRequest $request 
     * @return array
     */
    public function login(LoginRequest $request): array
    {
        $token = auth('api')->attempt([
            'email'     => $request->email,
            'password'  => $request->password
        ]);

        if (!$token) {
            throw new Exception('Usuário ou senha inválido');
        }

        return ['token' => $token];
    }

    /**
     * login
     *
     * @param \App\Http\Requests\RegisterRequest $request 
     * @return \App\Entities\User
     */
    public function register(RegisterRequest $request): User
    {
        $user = $this->userRepository->create([
            "name"  => $request->name,
            "email" => $request->email,
            "password"  => Hash::make($request->password),
        ]);

        return $user;
    }
}
