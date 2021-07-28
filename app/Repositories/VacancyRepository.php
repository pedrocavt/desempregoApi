<?php

namespace App\Repositories;

use App\Models\Vacancy;

class VacancyRepository
{
    public function all()
    {
        return Vacancy::all();
    }

    public function create($request)
    {
        return Vacancy::create($request->all());
    }

    public function show($vacancy)
    {
        return $vacancy;
    }

    public function update($request, $vacancy)
    {
        $vacancy->update($request->all());

        return $vacancy;
    }

    public function delete($vacancy)
    {
        $vaga = $vacancy->title;

        $vacancy->delete();

        return ['msg' => 'Vaga ' . $vaga . ' deletada com sucesso'];
    }
}
