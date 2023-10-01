<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class IsNotAdminException extends Exception
{
    public function render()
    {
        return response()->json('You are not an admin', Response::HTTP_UNAUTHORIZED);
    }
}
