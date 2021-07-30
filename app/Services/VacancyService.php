<?php

namespace App\Services;

use App\Entities\Vacancy;
use App\Http\Requests\VacancyRequest;
use App\Repositories\VacancyRepository;
use Illuminate\Database\Eloquent\Collection;

class VacancyService
{
    private $repository;

    public function __construct(VacancyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): Collection
    {
        return $this->repository->all();
    }

    public function store(VacancyRequest $request): Vacancy
    {
        return $this->repository->create($request->all());
    }

    public function update(VacancyRequest $request, Vacancy $vacancy): Vacancy
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
