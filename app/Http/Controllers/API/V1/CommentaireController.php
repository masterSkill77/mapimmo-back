<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Commentaire\CreateCommentaireRequest;
use App\Services\CommentaireService;
use Symfony\Component\HttpFoundation\Response;

class CommentaireController extends Controller
{
    public function __construct(public CommentaireService $commentaireService)
    {
    }
    public function sendCommentaire(CreateCommentaireRequest $createCommentaireRequest)
    {
        $commentaire = $this->commentaireService->store($createCommentaireRequest);
        return response()->json($commentaire, Response::HTTP_CREATED);
    }
    public function getCommentsByFormationUuid(string $uuid)
    {
        $commentaires = $this->commentaireService->getByFormationUuid($uuid);
        return response()->json($commentaires, Response::HTTP_OK);
    }
}
