<?php

namespace App\Services;

use App\Http\Requests\Commentaire\CreateCommentaireRequest;
use App\Models\Commentaire;

class CommentaireService
{
    public function __construct(public FormationService $formationService)
    {
    }
    public function store(CreateCommentaireRequest $createCommentaireRequest): Commentaire
    {
        $commentaire = new Commentaire($createCommentaireRequest->toArray());
        $commentaire->save();
        return $commentaire;
    }
    public function getByFormationUuid(string $uuid)
    {
        $formation = $this->formationService->getByUuid($uuid);
        return Commentaire::where('formation_id', $formation->id)->with(['admin', 'user', 'formation'])->get();
    }
}
