<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Services\UserService;
use App\Transformers\VacancyTransformer;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Vagas que postei
     * 
     * @throws Exception $e
     * @return Illuminate\Http\JsonResponse 
     */
    public function myVacancies(): JsonResponse
    {
        try {
            $user = auth()->user();
            $vacancies = $this->userService->vacancies($user);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json((new VacancyTransformer)->transformCollection($vacancies), 200);
    }

    /**
     * minhas aplicações

     * @throws Exception $e
     * @return Illuminate\Http\JsonResponse 
     */
    public function myApplications(): JsonResponse
    {
        try {
            $user = auth()->user();
            return response()->json($this->userService->applications($user));
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json((new VacancyTransformer)->transformCollection($vacancies), 200);
    }
}
