<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Request;

interface IService
{
    /**
     * @param Illuminate\Http\Client\Request $request
     * @return  Illuminate\Database\Eloquent\Model $savedCollection;
     */
    public function store(Request $data): Model;

    public function getById(int $collectionId): Model;
}
