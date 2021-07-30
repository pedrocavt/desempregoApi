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
     * 
     * @param  VacancyService  $vacancyService
     */
    public function __construct(VacancyService $vacancyService)
    {
        $this->vacancyService = $vacancyService;
    }

    /**
     * Exibe lista de vagas
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->vacancyService->index(), 200);
    }

    /**
     * Cria uma vaga
     * 
     * @param  VacancyRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(VacancyRequest $request): JsonResponse
    {
        $vacancy = $this->vacancyService->store($request);

        return response()->json((new VacancyTransformer)->transform($vacancy), 200);
    }

    /**
     * Mostra uma vaga especifica.
     *
     * @param  \App\Entities\Vacancy  $vacancy
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Vacancy $vacancy): JsonResponse
    {
        $vacancy = $this->vacancyService->show($vacancy);

        return response()->json((new VacancyTransformer)->transform($vacancy), 200);
    }

    /**
     * Atualiza uma vaga.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Vacancy  $vacancy
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(VacancyRequest $request, Vacancy $vacancy): JsonResponse
    {
        $vacancy = $this->vacancyService->update($request, $vacancy);

        return response()->json((new VacancyTransformer)->transform($vacancy), 200);
    }

    /**
     * Deleta uma vaga.
     *
     * @param  \App\Entities\Vacancy  $vacancy
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
