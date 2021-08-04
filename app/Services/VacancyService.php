<?php

namespace App\Services;

use App\Entities\Vacancy;
use App\Events\NewVacancy;
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
        $vacancy = $this->vacancyRepository->create([
            "title"         => $request->title,
            "description"   => $request->description,
            "wage"          => $request->wage,
            "category_id"   => $request->category_id,
            "user_id"       => auth()->user()->id
        ]);

        $eventNewVacancy = new NewVacancy(
            $vacancy->title,
            $vacancy->description,
            $vacancy->wage
        );

        event($eventNewVacancy);

        return $vacancy;
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
     * @throws Exception
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


    /**
     * applyVacancies
     *
     * @param int $id
     * @throws Exception
     * @return string
     */
    public function applyVacancies(int $id): string
    {
        $user = auth()->user();

        $vacancyApplied = $user->userApplyVacancies()->where('vacancy_id', $id)->first();


        if ($vacancyApplied) {
            throw new Exception("You already applied for this vagancy");
        }

        $vacancysPosted = $this->vacancyRepository->findWhere([
            "id"        => $id,
            "user_id"   => $user->id
        ])->first();

        if ($vacancysPosted) {
            throw new Exception("You cant to apply for your vagancy");
        }
        $vacancy = $this->vacancyRepository->find($id);

        $user->userApplyVacancies()->attach($id);


        return "You applied for $vacancy->title";
    }
}
