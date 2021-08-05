<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Transformers\VacancyTransformer;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        } catch (ModelNotFoundException $e) {
            return response()->json("This category doesnt exist", 404);
        } catch (Exception $e) {
            return response()->json(get_class($e), 404);
        }

        return response()->json((new VacancyTransformer)->transformCollection($vacancies), 200);
    }
}
