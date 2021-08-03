<?php

namespace App\Services;

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
     * @param int $id 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function vacancies(int $id): Collection
    {
        $user = $this->userRepository->find($id);

        return $user->vacancies()->get();
    }
}
