<?php

namespace App\Services;

use App\Models\Attestation;
use App\Models\User;

class AttestationService
{
    public function __construct()
    {
        // Constructeur de la classe
    }
    public function storeAttestation(User $user)
    {
    }
    public function getAllFormations(Attestation $attestation): array
    {
        $formations = [];
        $formationsId = explode(',', $attestation->formations);

        foreach ($formationsId as $formationId) {
            $formations[] =  (new FormationService)->getById($formationId);
        }
        return $formations;
    }
    public function getAttestationForUser(int $userId): Attestation
    {
        return Attestation::where('user_id', $userId)->where('deliver', false)->first();
    }
    public function getAllAttestationForUser(int $userId)
    {
        return Attestation::where('user_id', $userId)->where('deliver', true)->get();
    }
}
