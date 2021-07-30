<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Vacancy;

/**
 * Class VacancyTransformer.
 *
 * @package namespace App\Transformers;
 */
class VacancyTransformer extends TransformerAbstract
{
    /**
     * Transform the Vacancy entity.
     *
     * @param \App\Entities\Vacancy $model
     *
     * @return array
     */
    public function transform(Vacancy $model): array
    {
        return [
            'title'         => (string) $model->title,
            'description'   => (string) $model->description,
            'wage'          => (int) $model->wage
        ];
    }
}
