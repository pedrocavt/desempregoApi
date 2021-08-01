<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    private $userService;

    /**
     * construct
     *
     * @param \App\Services\UserService $userService 
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * login
     *
     * @param \App\Http\Requests\LoginRequest $request 
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        return $this->userService->login($request);
    }
}
