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
            $id = auth()->user()->id;
            $vacancies = $this->userService->vacancies($id);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }

        return response()->json((new VacancyTransformer)->transformCollection($vacancies), 200);
    }
}
