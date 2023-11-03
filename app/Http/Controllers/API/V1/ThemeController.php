<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Theme\CreateThemRequest;
use App\Services\ThemeService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ThemeController extends Controller
{
    public function __construct(public ThemeService $themeService)
    {

    }

    public function store(CreateThemRequest $request): JsonResponse
    {
        $theme = $this->themeService->store($request);
        return response()->json($theme, 201);
    }

    public function index()
    {
        $theme = $this->themeService->getAllTheme();

        return response()->json($theme);
    }

    public function getById($themeId): JsonResponse
    {
        $theme = $this->themeService->getById($themeId);
        if(!$theme) {
            throw new NotFoundHttpException("theme `$themeId` not found");
        }

        return response()->json($theme);
    }

    public function update(Request $request, $themeId): JsonResponse
    {
        $theme = $this->themeService->update($request->all(), $themeId);
        if ($theme) {
            return response()->json($theme, 200);
        } else {
            throw new NotFoundHttpException("Erreur de la modification");
        }
    }

    public function delete($themeId): JsonResponse
    {
        $theme = $this->themeService->delete($themeId);
        if ($theme) {
            return response()->json($theme);
        } else {
            throw new NotFoundHttpException("Erreur de la suppresion");
        }
    }
}
