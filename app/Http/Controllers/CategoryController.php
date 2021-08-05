<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Transformers\VacancyTransformer;
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
     * Pega as vagas de uma categoria
     *
     * @param int $id 
     * @throws Exception $e
     * @return Illuminate\Http\JsonResponse 
     */
    public function getVacanciesByCategory(int $id): JsonResponse
    {
        try {
            $vacancies = $this->categoryService->vacancies($id);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 404);
        }

        return response()->json((new VacancyTransformer)->transformCollection($vacancies), 200);
    }
}
