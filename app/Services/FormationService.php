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
    public function getById(int $collectionId): Formation
    {
        return new Formation;
    }
}
