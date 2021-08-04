<?php

namespace App\Services;

use App\Entities\User;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * vacancies
     *
     * @param \App\Entities\User $user 
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
     * applications
     *
     * @param \App\Entities\User $user 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function applications(User $user): Collection
    {
        $vacancies = $user->userApplyVacancies()->get();

        if (count($vacancies) < 1) {
            throw new Exception("You dont applied any vacancy");
        }
        return $vacancies;
    }
}
