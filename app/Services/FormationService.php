<?php

namespace App\Services;

use App\Models\Formation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Request;

class FormationService implements IService
{
    public function store(Request $data): Formation
    {
        return new Formation;
    }
    public function getById(int $formationId): Formation
    {
        $formation = Formation::where('id', $formationId)->with(['chapters', 'chapters.lessons', '']);
        return $formation;
    }
}
