<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Formation\CreateFormationRequest;
use App\Models\Formation;
use App\Services\FormationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FormationController extends Controller
{
    public function __construct(public FormationService $formationService)
    {
    }
    public function getById(int $formationId): JsonResponse
    {
        $formation = $this->formationService->getById($formationId);
        if (!$formation)
            throw new NotFoundHttpException("Formation with `$formationId` not found");
        return response()->json($formation);
    }

    public function getByUuid(string $formationUuid): JsonResponse
    {
        $formation = $this->formationService->getByUuid($formationUuid);
        if (!$formation)
            throw new NotFoundHttpException("Formation with `$formationUuid` not found");
        return response()->json($formation);
    }

    public function index(): JsonResponse
    {
        $formations = $this->formationService->getAll();
        return response()->json($formations);
    }

    public function store(CreateFormationRequest $request): JsonResponse
    {
        $path = $request->file('photo')->storeAs('public/formation', time() . '.' . $request->file('photo')->getClientOriginalExtension());
        $data = $request->validated();
        $path = str_replace('public/', '', $path);
        $data['photo'] = '/' . $path;
        $data['uuid'] = Str::uuid();
        $formation = $this->formationService->store($data);
        return response()->json($formation, Response::HTTP_CREATED);
    }
    public function getMyCourse(): JsonResponse
    {
        $user = auth()->user();
        $formation = $this->formationService->getUserFormation($user->id);

        return response()->json($formation);
    }

    public function takeFormation(string $id): JsonResponse
    {
        $user = auth()->user();
        $formation = $this->formationService->getByUuid($id);
        $taken = $this->formationService->subscribeUserToFormation($user->id, $formation->id);
        return response()->json($taken, Response::HTTP_CREATED);
    }

    public function makeLessonDone(Request $request, string $id): JsonResponse
    {
        $user = auth()->user();
        $formation = $this->formationService->getByUuid($id);
        $lessonDone = (int) $request->input('lesson_done');
        $taken = $this->formationService->makeLessonDone($user->id, $formation->id, $lessonDone);
        return response()->json($taken, Response::HTTP_CREATED);
    }
}
