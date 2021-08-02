<?php

namespace App\Http\Controllers;

use App\Entities\Category;
use Exception;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * getVacancys
     *
     * @param int $id 
     * @throws Exception $e
     * @return Illuminate\Http\JsonResponse 
     */
    public function getVacancys(int $id): JsonResponse
    {
        try {
            $category = Category::find($id);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }

        return response()->json($category->vacancys()->get(), 200);
    }
}
