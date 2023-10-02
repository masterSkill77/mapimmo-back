<?php

namespace App\Services;

use App\Models\Formation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Request;

class FormationService implements IService
{
    public function store($data): Formation
    {
        return Formation::create($data);
    }
    public function getById(int $formationId): Formation
    {
        return  Formation::where('id', $formationId)->with(['chapters', 'chapters.lessons', 'questions'])->first();
    }

    public function getByUuid(string $formationUuid): Formation
    {
        return  Formation::where('uuid', $formationUuid)->with(['chapters', 'chapters.lessons', 'questions'])->first();
    }

    public function getAll(): Collection
    {
        return Formation::with(['chapters', 'chapters.lessons', 'questions'])->get();
    }

    public function update($data, int $formationId): Formation
    {

        return Formation::where('id', $formationId)->update($data);
    }

    public function delete($formationId): Formation
    {

        return Formation::where('id', $formationId)->delete();
    }
}
