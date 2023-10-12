<?php

namespace App\Services;

use App\Models\Formation;
use App\Models\UserFormation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Request;

class FormationService implements IService
{
    public function store($data): Formation
    {

        return Formation::create($data);
    }
    public function getById(int $formationId): Formation
    {
        return  Formation::where('id', $formationId)->with(['chapters', 'chapters.lessons',  'usersTaking', 'commentaires', 'commentaires.user', 'commentaires.admin'])->first();
    }

    public function getByUuid(string $formationUuid): Formation
    {
        return  Formation::where('uuid', $formationUuid)->with(['chapters', 'chapters.lessons',  'usersTaking', 'commentaires', 'commentaires.user', 'commentaires.admin', 'questions'])->first();
    }

    public function getAll(): Collection
    {
        return Formation::with(['chapters', 'chapters.lessons',  'usersTaking', 'commentaires', 'commentaires.user', 'commentaires.admin'])->get();
    }

    public function update($data, int $formationId): Formation
    {

        return Formation::where('id', $formationId)->update($data);
    }

    public function delete($formationId): Formation
    {

        return Formation::where('id', $formationId)->delete();
    }

    public function getUserFormation(int $userId): Collection
    {
        return UserFormation::with('formation', 'formation.chapters', 'formation.commentaires', 'formation.commentaires.user', 'formation.commentaires.admin')->where('user_id', $userId)->get();
    }
    /**
     * Inscription de l'user dans une formation
     */
    public function subscribeUserToFormation(int $userId, int $formationId): UserFormation
    {
        $subscribed = new UserFormation([
            'user_id' => $userId,
            'formation_id' => $formationId
        ]);

        $subscribed->save();
        return $subscribed;
    }
    public function makeLessonDone(int $userId, int $formationId, int $lessonDone): UserFormation
    {
        $userFormation = UserFormation::where('user_id', $userId)->where('formation_id', $formationId)->first();
        $userFormation->current_done = $lessonDone;
        $userFormation->update();
        return $userFormation;
    }
}
