<?php

namespace App\Services;

use App\Entities\User;
use App\Repositories\UserRepository;
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
        return $user->vacancies()->get();
    }

    /**
     * applications
     *
     * @param \App\Entities\User $user 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function applications(User $user): Collection
    {
        return $user->userApplyVacancies()->get();
    }
}
