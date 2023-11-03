<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lesson\LessonCreateRequest;
use App\Services\LessonService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LessonController extends Controller
{
    public function __construct (public LessonService $lessonservice)
    {
    
    }

    public function  index(): JsonResponse
    {
        $lessons = $this->lessonservice->getAll();
        return response()->json($lessons);
    }

    public function store(LessonCreateRequest $request) : JsonResponse
    {
        $data = $request->validated();
        $lesson = $this->lessonservice->store($data);
        return response()->json($lesson);
    }

    public function getById(int $lessonId): JsonResponse
    {
        $lesson = $this->lessonservice->getById($lessonId);
        if (!$lesson)
            throw new NotFoundHttpException("Lesson not found with `$lessonId`");
        return response()->json($lesson);
    }

    public function update(Request $request): JsonResponse
    {
        $orders = $request->input('orders');
        try {
            foreach($orders as $order) {
                $this->lessonservice->update($order, $order['id']);
            }
            return response()->json([
                'message' => 'Lesson updated successfully'
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
