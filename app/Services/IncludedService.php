<?php

namespace App\Services;

use App\Models\Included;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IncludedService
{
    public function store($data): Included
    {

        return Included::create($data);
    }

    public function getAll() :Collection
    {
        return Included::with('formation')->get();
    }

    public function getById(int $includedId) : Included
    {
        return Included::with('formation')->find($includedId);
    }

    public function update($data, int $includedId): Included{
        
        $included = Included::find($includedId);
        $included->update($data);
        return $included;
    }

    public function delete(int $included): string
    {
        return Included::where('id', $included)->delete();
    } 
}