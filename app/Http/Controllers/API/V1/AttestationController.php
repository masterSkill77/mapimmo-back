<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\AttestationService;
use Barryvdh\DomPDF\Facade\Pdf;
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
    public function getAttestationForUser(int $attestationId)
    {
        $attestation = $this->attestationService->getAttestation($attestationId);

        $pdf = PDF::loadView('certificate', ['attestation' => $attestation]);
        $pdf->setPaper(array(0, 0, 1000, 800), 'landscape');
        $pdf->setOption('pdfBackend', 'GD');
        $pdf->render();
        return ($pdf->download('attestation.png'));
    }
}
