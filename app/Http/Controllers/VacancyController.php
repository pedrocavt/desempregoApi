<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacancyRequest;
use App\Entities\Vacancy;
use App\Services\VacancyService;
use App\Transformers\VacancyTransformer;

class VacancyController extends Controller
{
    private $vacancyService;

    public function __construct(VacancyService $vacancyService)
    {
        $this->vacancyService = $vacancyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->vacancyService->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  VacancyRequest  $request
     * @return array
     */
    public function store(VacancyRequest $request): array
    {
        $vacancy = $this->vacancyService->store($request);

        return (new VacancyTransformer)->transform($vacancy);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return array
     */
    public function show(Vacancy $vacancy): array
    {
        $vacancy = $this->vacancyService->show($vacancy);

        return (new VacancyTransformer)->transform($vacancy);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vacancy  $vacancy
     * @return array
     */
    public function update(VacancyRequest $request, Vacancy $vacancy): array
    {
        $vacancy = $this->vacancyService->update($request, $vacancy);

        return (new VacancyTransformer)->transform($vacancy);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacancy $vacancy)
    {
        $title = $vacancy->title;

        $this->vacancyService->destroy($vacancy);

        return [
            'msg' => 'A vaga ' . $title . ' foi deletada sucesso'
        ];
    }
}
