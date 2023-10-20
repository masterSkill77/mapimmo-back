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
    public function deliverAttestation(User $user)
    {
        $attestation = $this->getAttestationForUser($user->id);
        $attestation->deliver = true;
        $attestation->save();
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
    public function getAttestationForUser(int $userId): Attestation | null
    {
        return Attestation::where('user_id', $userId)->where('deliver', false)->first();
    }
    public function getAllAttestationForUser(int $userId)
    {
        return Attestation::where('user_id', $userId)->where('deliver', true)->get();
    }
}
