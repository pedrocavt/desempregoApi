<?php

namespace App\Services;

use App\Entities\Vacancy;
use App\Http\Requests\VacancyRequest;
use App\Repositories\VacancyRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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

        return $this->repository->create([
            "title"         => $request->title,
            "description"   => $request->description,
            "wage"          => $request->wage,
            "category_id"   => $request->category_id,
            "user_id"       => auth()->user()->id
        ]);
    }

    /**
     * atualiza uma vaga
     *
     * @param \App\Http\Requests\VacancyRequest $request 
     * @param int $id
     * @return \App\Entities\Vacancy
     */
    public function update(VacancyRequest $request, int $id): Vacancy
    {
        return $this->repository->update($request->all(), $id);
    }

    /**
     * show
     *
     * @param int $id 
     * @return \App\Entities\Vacancy
     */
    public function show(int $id): Vacancy
    {
        $vacancy = $this->repository->find($id);

        return $vacancy;
    }
    /**
     * deleta uma vaga
     *
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
