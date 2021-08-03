<?php

namespace App\Services;

use App\Entities\Vacancy;
use App\Http\Requests\VacancyRequest;
use App\Repositories\VacancyRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;


class VacancyService
{
    private $vacancyRepository;

    /**
     * construct
     *
     * @param \App\Repositories\VacancyRepository $vacancyRepository 
     */
    public function __construct(VacancyRepository $vacancyRepository)
    {
        $this->vacancyRepository = $vacancyRepository;
    }

    /**
     * Exibe uma lista de vagas
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(): Collection
    {
        return $this->vacancyRepository->all();
    }

    /**
     * cria uma vaga
     *
     * @param \App\Http\Requests\VacancyRequest $request
     * @return \App\Entities\Vacancy
     */
    public function store(VacancyRequest $request): Vacancy
    {
        return $this->vacancyRepository->create([
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
     * @throws Exception 
     * @return \App\Entities\Vacancy
     */
    public function update(VacancyRequest $request, int $id): Vacancy
    {
        $vacancy = $this->vacancyRepository->find($id);

        if ($vacancy->user_id != auth()->user()->id) {
            throw new Exception("You didnt post this vacancy");
        }

        return $this->vacancyRepository->update($request->all(), $id);
    }

    /**
     * show
     *
     * @param int $id 
     * @return \App\Entities\Vacancy
     */
    public function show(int $id): Vacancy
    {
        $vacancy = $this->vacancyRepository->find($id);

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
        $vacancy = $this->vacancyRepository->find($id);

        if ($vacancy->user_id != auth()->user()->id) {
            throw new Exception("You didnt post this vacancy");
        }

        return $this->vacancyRepository->delete($id);
    }

    public function applyVacancies($id): string
    {
        $user = auth()->user();

        $user->userApplyVacancies()->attach($id);

        $vacancy = Vacancy::find($id);

        return "Você aplicou para a vaga $vacancy->title";
    }
}
