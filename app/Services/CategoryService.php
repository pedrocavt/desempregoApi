<?php

namespace App\Services;

use App\Entities\Category;
use App\Repositories\CategoryRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    private $categoryRepository;

    /**
     * construct
     *
     * @param \App\Repositories\CategoryRepository $categoryRepository 
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Pega as vagas de uma categoria
     *
     * @param int $id 
     * @throws Exception
     * @return \Illuminate\Database\Eloquent\Collection;
     */
    public function vacancies(int $id): Collection
    {
        $category = $this->categoryRepository->find($id);

        if (!$category) {
            throw new Exception("Category doesnt exist");
        }

        $vacancies = $category->vacancies()->get();

        return $vacancies;
    }
}
