<?php

namespace App\Services;

use App\Repositories\VacancyRepository;

class VacancyService
{
    private $repository;

    public function __construct(VacancyRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index()
    {
        return $this->repository->all();
    }

    public function store($request)
    {
        return $this->repository->create($request->all());
    }

    public function update($request, $vacancy)
    {
        return $this->repository->update($request->all(), $vacancy->id);
    }

    public function show($vacancy)
    {
        return $this->repository->find($vacancy->id);
    }

    public function destroy($vacancy)
    {
        return $this->repository->delete($vacancy->id);
    }
}
