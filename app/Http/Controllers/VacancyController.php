<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacancyRequest;
use App\Entities\Vacancy;
use App\Services\VacancyService;
use App\Transformers\VacancyTransformer;
use Illuminate\Http\JsonResponse;

class VacancyController extends Controller
{
    private $vacancyService;

    /**
     * Cria uma intancia do service
     * @param  VacancyService  $vacancyService
     */
    public function __construct(VacancyService $vacancyService)
    {
        $this->vacancyService = $vacancyService;
    }

    /**
     * Exibe lista de vagas
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->vacancyService->index(), 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param  VacancyRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(VacancyRequest $request): JsonResponse
    {
        $vacancy = $this->vacancyService->store($request);

        return response()->json((new VacancyTransformer)->transform($vacancy), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Vacancy $vacancy): JsonResponse
    {
        $vacancy = $this->vacancyService->show($vacancy);

        return response()->json((new VacancyTransformer)->transform($vacancy), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(VacancyRequest $request, Vacancy $vacancy): JsonResponse
    {
        $vacancy = $this->vacancyService->update($request, $vacancy);

        return response()->json((new VacancyTransformer)->transform($vacancy), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Vacancy $vacancy): JsonResponse
    {
        $title = $vacancy->title;

        $this->vacancyService->destroy($vacancy);

        return response()->json([
            'msg' => 'A vaga ' . $title . ' foi deletada sucesso'
        ], 200);
    }
}
