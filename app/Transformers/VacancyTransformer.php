<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Vacancy;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class VacancyTransformer.
 *
 * @package namespace App\Transformers;
 */
class VacancyTransformer extends TransformerAbstract
{
    /**
     * Transform the Vacancy entity.
     * @param \App\Entities\Vacancy $model
     * @return array
     */
    public function transform(Vacancy $model): array
    {
        return [
            'title'         => (string) $model->title,
            'description'   => (string) $model->description,
            'wage'          => (int) $model->wage,
            'user_id'       => (int) $model->user_id,
            'category_id'   => (int) $model->category_id

        ];
    }

    /**
     * transformCollection
     *
     * @param \Illuminate\Database\Eloquent\Collection $models 
     * @return array
     */
    public function transformCollection(Collection $models): array
    {
        foreach ($models as $model) {
            $data[] = [
                "title"         => $model->title,
                "description"   => $model->description,
                "wage"          => $model->wage,
                "user_id"       => $model->user_id,
                "category_id"   => $model->category_id
            ];
        }

        return $data;
    }
}
