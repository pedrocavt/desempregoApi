<?php

namespace App\Services;

use App\Entities\User;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    /**
     * Busca as vagas que postei
     *
     * @param \App\Entities\User $user
     * @throws Exception
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function vacancies(User $user): Collection
    {
        $vacancies = $user->vacancies()->get();
        if (count($vacancies) < 1) {
            throw new Exception("You dont posted any vacancy");
        }

        return $vacancies;
    }

    /**
     * Busca as vagas que apliquei
     *
     * @param \App\Entities\User $user 
     * @throws Exception
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function applications(User $user): LengthAwarePaginator
    {
        $vacancies = $user->userApplyVacancies()->paginate(1);

        if (count($vacancies) < 1) {
            throw new Exception("You dont applied any vacancy");
        }
        return $vacancies;
    }
}
