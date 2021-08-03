<?php

namespace App\Http\Controllers;

use App\Entities\Category;
use App\Serices\CategoryService;
use Exception;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{

    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * getVacancies
     *
     * @param int $id 
     * @throws Exception $e
     * @return Illuminate\Http\JsonResponse 
     */
    public function getVacancies(int $id): JsonResponse
    {
        try {
            $this->categoryService->vacancies($id);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }

        return response()->json($vacancies, 200);
    }
}
