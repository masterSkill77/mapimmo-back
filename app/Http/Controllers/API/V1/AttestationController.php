<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\AttestationService;
use Illuminate\Http\Request;

class AttestationController extends Controller
{
    public function __construct(protected AttestationService $attestationService)
    {
    }
    public function getAllAttestationForUser()
    {
        $user = auth()->user();
        $attestations = $this->attestationService->getAllAttestationForUser($user->id);
        return response()->json($attestations);
    }
}
