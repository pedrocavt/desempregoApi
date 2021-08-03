<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacancyRequest;
use App\Entities\Vacancy;
use App\Services\VacancyService;
use App\Transformers\VacancyTransformer;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class VacancyController extends Controller
{
    private $vacancyService;

    /**
     * Cria uma intancia do service
     * 
     * @param \App\Services\VacancyService  $vacancyService
     */
    public function __construct(VacancyService $vacancyService)
    {
        $this->vacancyService = $vacancyService;
    }

    /**
     * Exibe lista de vagas
     * 
     * @throws Exception $e
     * @throws Illuminate\Database\QueryException $e
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $vacancys = $this->vacancyService->index();
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        } catch (QueryException $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json((new VacancyTransformer)->transformCollection($vacancys), 200);
    }

    /**
     * Cria uma vaga
     * 
     * @param  \App\Http\Requests\VacancyRequest  $request
     * @throws Exception $e
     * @throws Illuminate\Database\QueryException $e
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(VacancyRequest $request): JsonResponse
    {
        try {
            $vacancy = $this->vacancyService->store($request);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        } catch (QueryException $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json((new VacancyTransformer)->transform($vacancy), 200);
    }

    /**
     * mostra uma vaga
     *
     * @param int $id
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundExceptions $e
     * @throws Illuminate\Database\QueryException $e
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $vacancy = $this->vacancyService->show($id);
        } catch (ModelNotFoundException $e) {
            return response()->json("Vacancy of id: $id not found", 404);
        } catch (QueryException $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json((new VacancyTransformer)->transform($vacancy), 200);
    }

    /**
     * Atualiza uma vaga.
     *
     * @param  \App\Http\Requests\VacancyRequest  $request
     * @param int $id
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundExceptions $e
     * @throws Illuminate\Database\QueryException $e
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(VacancyRequest $request, int $id): JsonResponse
    {
        try {
            $vacancy = $this->vacancyService->update($request, $id);
        } catch (ModelNotFoundException $e) {
            return response()->json("Vacancy of id: $id not found", 404);
        } catch (QueryException $e) {
            return response()->json($e->getMessage(), 500);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json((new VacancyTransformer)->transform($vacancy), 200);
    }

    /**
     * Deleta uma vaga.
     *
     * @param  int $id
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundExceptions $e
     * @throws Illuminate\Database\QueryException $e
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $vacancy = $this->vacancyService->show($id);
            $this->vacancyService->destroy($id);
        } catch (ModelNotFoundException $e) {
            return response()->json("Vacancy of id: $id not found", 404);
        } catch (QueryException $e) {
            return response()->json($e->getMessage(), 500);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json([
            'msg' => 'A vaga ' . $vacancy->title . ' foi deletada sucesso'
        ], 200);
    }
}
