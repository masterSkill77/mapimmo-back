<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Request;
use Illuminate\Database\Eloquent\Collection;

interface IService
{
    /**
     * @param Illuminate\Http\Client\Request $request
     * @return  Illuminate\Database\Eloquent\Model $savedCollection;
     */
    public function store(Request $data): Model;

    public function getById(int $collectionId): Model;

    public function getAll(): Collection;
}
