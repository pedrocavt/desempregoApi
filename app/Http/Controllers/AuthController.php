<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    private $authService;

    /**
     * construct
     *
     * @param \App\Services\AuthService $AuthService 
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * login
     *
     * @param \App\Http\Requests\LoginRequest $request 
     * @throws Exception $e
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            return response()->json($this->authService->login($request), 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 401);
        }
    }

    /**
     * register
     *
     * @param \App\Http\Requests\RegisterRequest $request 
     * @throws Exception $e
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            return response()->json($this->authService->register($request), 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
