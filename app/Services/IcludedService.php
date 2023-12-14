<?php

namespace App\Services;

use App\Models\Included;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IcludedService implements IService
{
    public function store($data): Included
    {

        return Included::create($data);
    }
}