<?php

namespace App\Services;

use App\Models\Attestation;
use App\Models\Formation;
use App\Models\User;
use Carbon\Carbon;

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
        $attestation->hour_done = $user->hour_remains;
        $user->hour_remains = null;
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
        return Attestation::where('user_id', $userId)->with('user')->where('deliver', true)->get();
    }

    public function getAttestation(int $attestationId)
    {
        $attestation = Attestation::where('id', $attestationId)->with('user')->first();
        $attestation->done = (new Carbon($attestation->hour_done))->format('H');
        $attestation->start = (new Carbon($attestation->created_at))->format('d/m/Y');
        $attestation->end = (new Carbon($attestation->updated))->format('d/m/Y');
        $formationIds = explode(',', $attestation->formations);
        $formations = [];
        foreach ($formationIds as $formationId) {
            $formations[] = Formation::where('id', $formationId)->first();
        }
        $attestation->allFormations = $formations;
        return $attestation;
    }
}
