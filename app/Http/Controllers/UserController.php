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
     * myVacancys
     *
     * @return Illuminate\Http\JsonResponse 
     */
    public function myVacancies(): JsonResponse
    {
        try {
            $user = auth()->user();
            $vacancies = $this->userService->vacancies($user);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }

        return response()->json((new VacancyTransformer)->transformCollection($vacancies), 200);
    }

    /**
     * myApplications
     *
     * @return Illuminate\Http\JsonResponse 
     */
    public function myApplications(): JsonResponse
    {
        try {
            $user = auth()->user();
            $vacancies = $this->userService->applications($user);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }

        return response()->json((new VacancyTransformer)->transformCollection($vacancies), 200);
    }
}
