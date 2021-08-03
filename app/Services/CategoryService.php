<?php

namespace App\Serices;

use App\Entities\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    /**
     * vacancies
     *
     * @param int $id 
     * @return \Illuminate\Database\Eloquent\Collection;
     */
    public function vacancies(int $id): Collection
    {
        $category = Category::find($id);

        $vacancies = $category->vacancies()->get();

        return $vacancies;
    }
}
