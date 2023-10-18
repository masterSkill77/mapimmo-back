<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Commentaire\CreateCommentaireRequest;
use App\Http\Requests\Commentaire\ReplyCommentaireRequest;
use App\Services\CommentaireService;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Commentaire;
use Illuminate\Support\Facades\DB;


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

    public function getAllCommentaires() {
        $commentaires = $this->commentaireService->index();
        return response()->json($commentaires);
    }

    public function getCommentaireswithResponse(){
        $commentaire = $this->commentaireService->commentswithresponse();
        return response()->json($commentaire);
    }

    public function getCommentaireswithoutResponse(){
      
        $commentaire = $this->commentaireService->commentswithoutreponse();
        return response()->json($commentaire);
    }
    public function replyCommentaire(ReplyCommentaireRequest $replyCommentaireRequest)
    {
        $commentaire = $this->commentaireService->reply($replyCommentaireRequest);
        return response()->json($commentaire, Response::HTTP_OK);
    }
}
