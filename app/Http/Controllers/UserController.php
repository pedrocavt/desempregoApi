<?php

namespace App\Http\Controllers;

use App\Entities\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * myVacancys
     *
     * @return Illuminate\Http\JsonResponse 
     */
    public function myVacancies(): JsonResponse
    {
        try {
            $id = auth()->user()->id;

            $user = User::find($id);

            $vacancies = $user->vacancies()->get();
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }

        return response()->json($vacancies, 200);
    }
}
