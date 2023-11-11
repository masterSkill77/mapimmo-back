<?php

use App\Http\Controllers\API\V1\AttestationController;
use App\Http\Controllers\API\V1\ChapterController;
use App\Http\Controllers\API\V1\CommentaireController;
use App\Http\Controllers\API\V1\FormationController;

use App\Http\Controllers\API\V1\LessonController;
use App\Http\Controllers\API\V1\PlanController;
use App\Http\Controllers\API\V1\QuestionController;
use App\Http\Controllers\API\V1\QuizzController;
use App\Http\Controllers\API\V1\SubscriptionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\API\V1\OrderController;
use App\Http\Controllers\API\V1\ThemeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route generé "api/v1/"

Route::prefix('/v1')->group(function () {
    Route::prefix("/formation")->group(function () {
        Route::get('/', [FormationController::class, 'index']);
        Route::get('/{id}', [FormationController::class, 'getById']);
        Route::get('/uuid/{formationUuid}', [FormationController::class, 'getByUuid']);
        Route::post('/', [FormationController::class, 'store']);
        Route::post('/{id}', [FormationController::class, 'update']);
        Route::delete('/{id}', [FormationController::class, 'delete']);
        Route::prefix('/{id}')->group(function () {
            Route::post('/question', [QuestionController::class, 'store']);
            Route::post('/take-course', [FormationController::class, 'takeFormation'])->middleware('auth:sanctum');
            Route::post('/make-done', [FormationController::class, 'makeLessonDone'])->middleware('auth:sanctum');
        });
    });
    Route::prefix("/chapter")->group(function () {
        Route::get('/', [ChapterController::class, 'index']);
        Route::get('/{id}', [ChapterController::class, 'getById']);
        Route::post('/', [ChapterController::class, 'store']);
        Route::put('/formation', [ChapterController::class, 'updateChapiterInFormation']);
        Route::put('/{id}', [ChapterController::class, 'update']);
        Route::delete('/{id}', [ChapterController::class, 'delete']);
    });
    Route::prefix("/lessons")->group(function () {
        Route::apiResource('/', LessonController::class);
        Route::put('/chapter', [LessonController::class, 'update']);
        Route::get('/', [LessonController::class, 'index']);
        Route::get('/{id}', [LessonController::class, 'getById']);
    });
    Route::prefix("/auth")->group(function () {
        Route::post("register", RegisterController::class);
        Route::post("login", LoginController::class);
        Route::middleware('auth:sanctum')->put("/{id}", [UserController::class, 'update']);
    });
    Route::prefix('/subscription')->group(function () {
        Route::post('subscribe', [SubscriptionController::class, 'subscribeToModule'])->middleware('auth:sanctum');
    });

    Route::prefix('/plan')->group(function () {
        Route::post('/', [PlanController::class, 'store']);
        Route::get('/', [PlanController::class, 'index']);
        Route::get('/{id}', [PlanController::class, 'getById']);
        Route::put('/{id}', [PlanController::class, 'update']);
        Route::delete('/{id}', [PlanController::class, 'delete']);
    });

    Route::prefix('/quizz')->group(function () {
        Route::post('/', [QuizzController::class, 'storeQuizz'])->middleware(['auth:sanctum']);
    });

    Route::prefix('/dashboard')->group(function () {
        Route::get('/my-plateforme', [FormationController::class, 'getMyCourse'])->middleware('auth:sanctum');
        Route::get('/my-quizz', [QuizzController::class, 'getMyQuizz'])->middleware('auth:sanctum');
    });

    Route::prefix('/commentaire')->group(function () {
        Route::post('/store', [CommentaireController::class, 'sendCommentaire']);
        Route::get('', [CommentaireController::class, 'getAllCommentaires'])->middleware('auth:sanctum');
        //Route::get('/{uuid}', [CommentaireController::class, 'getCommentsByFormationUuid']);
        Route::get('/with-response', [CommentaireController::class, 'getCommentaireswithResponse']);
        Route::get('/without-response', [CommentaireController::class, 'getCommentaireswithoutResponse']);
        Route::post('/reply', [CommentaireController::class, 'replyCommentaire'])->middleware('auth:sanctum');
    });

    Route::post('/payment', [PlanController::class, 'pay'])->middleware(['auth:sanctum']);
    Route::get('/download-invoice/{id}/{token}', [OrderController::class, 'generateInvoice']);
    Route::apiResource('/order', OrderController::class)->middleware(['auth:sanctum']);

    Route::prefix("/question")->group(function () {
        Route::get('/', [QuestionController::class, 'index']);
        Route::get('/{id}', [QuestionController::class, 'getById']);
        Route::put('/{id}', [QuestionController::class, 'update']);
        Route::delete('/{id}', [QuestionController::class, 'delete']);
    });
    Route::prefix("/user")->group(function () {
        Route::get("/", [UserController::class, 'index']);
        Route::post("/register", RegisterController::class);
        Route::put("/{id}", [UserController::class, 'update']);
        Route::get("/{id}", [UserController::class, 'getById']);
    });
    Route::prefix("/theme")->group(function () {
        Route::get("/", [ThemeController::class, 'index']);
        Route::get("/{id}", [ThemeController::class, 'getById']);
        Route::post("/", [ThemeController::class, 'store']);
        Route::put("/{id}", [ThemeController::class, 'update']);
        Route::delete("/{id}", [ThemeController::class, 'delete']);
    });
    Route::prefix('/attestation')->group(function () {
        Route::get('/', [AttestationController::class, 'getAllAttestationForUser'])->middleware(['auth:sanctum']);
        Route::get('/{id}', [AttestationController::class, 'getAttestationForUser']);
    });
});
