<?php

namespace App\Services;

use App\Entities\Vacancy;
use App\Http\Requests\VacancyRequest;
use App\Repositories\VacancyRepository;
use Illuminate\Database\Eloquent\Collection;

class VacancyService
{
    private $repository;

    /**
     * construct
     *
     * @param \App\Repositories\VacancyRepository $repository 
     */
    public function __construct(VacancyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Exibe uma lista de vagas
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(): Collection
    {
        return $this->repository->all();
    }

    /**
     * cria uma vaga
     *
     * @param \App\Http\Requests\VacancyRequest $request
     * @return \App\Entities\Vacancy
     */
    public function store(VacancyRequest $request): Vacancy
    {
        return $this->repository->create($request->all());
    }

    /**
     * atualiza uma vaga
     *
     * @param \App\Http\Requests\VacancyRequest $request 
     * @param \App\Entities\Vacancy $vacancy 
     * @return \App\Entities\Vacancy
     */
    public function update(VacancyRequest $request, Vacancy $vacancy): Vacancy
    {
        return $this->repository->update($request->all(), $vacancy->id);
    }

    /**
     * mostra uma vaga especifica
     *
     * @param \App\Entities\Vacancy $vacancy 
     * @return \App\Entities\Vacancy
     */
    public function show(Vacancy $vacancy): Vacancy
    {
        return $this->repository->find($vacancy->id);
    }

    /**
     * deleta uma vaga
     *
     * @param \App\Entities\Vacancy $vacancy 
     * @return bool
     */
    public function destroy(Vacancy $vacancy): bool
    {
        return $this->repository->delete($vacancy->id);
    }
}
