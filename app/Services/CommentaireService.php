<?php

namespace App\Services;

use App\Http\Requests\Commentaire\CreateCommentaireRequest;
use App\Http\Requests\Commentaire\ReplyCommentaireRequest;
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
    public function index(){
        return Commentaire::with(['admin', 'user', 'formation'])->get();
    } 

    public function reply(ReplyCommentaireRequest $replyCommentaireRequest){
        $user = auth()->user();
        $commentaire = $replyCommentaireRequest->toArray();
        $commentaire['admin_id'] = $user->id;
        return Commentaire::create($commentaire);
    }

    public function commentswithoutreponse(){
        $commentaire = Commentaire::where(function ($query) {
            $query->whereNotIn('id', function ($subquery) {
                $subquery->select('response_to')
                    ->from('commentaires')
                    ->whereNotNull('response_to');
            });
        })->whereNull('response_to')->with([ 'user', 'formation'])->orderBy('created_at', 'desc')
        ->get();
        return $commentaire;
    }
    public function commentswithresponse()
    {
        $commentaire = Commentaire::has('responsefor')->with(['admin', 'user', 'formation', 'responsefor'])
        ->orderBy('created_at', 'desc')->get();
        return $commentaire;
    }
}
