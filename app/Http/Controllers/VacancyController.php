<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacancyRequest;
use App\Models\Vacancy;
use App\Services\VacancyService;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    private $service;

    public function __construct(VacancyService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->service->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  VacancyRequest  $request
     * @return Vacancy
     */
    public function store(VacancyRequest $request): Vacancy
    {
        return $this->service->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return Vacancy
     */
    public function show(Vacancy $vacancy): Vacancy
    {
        return $this->service->show($vacancy);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vacancy  $vacancy
     * @return Vacancy
     */
    public function update(VacancyRequest $request, Vacancy $vacancy): Vacancy
    {
        return $this->service->update($request, $vacancy);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacancy $vacancy)
    {
        return $this->service->destroy($vacancy);
    }
}
