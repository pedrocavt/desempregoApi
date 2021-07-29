<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
    public function login(LoginRequest $request)
    {
        return $this->service->login($request);
    }
}
