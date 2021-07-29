<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\VacancyRepository;
use App\Entities\Vacancy;

/**
 * Class VacancyRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class VacancyRepositoryEloquent extends BaseRepository implements VacancyRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Vacancy::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
