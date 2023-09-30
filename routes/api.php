<?php

use App\Http\Controllers\API\V1\ChapterController;
use App\Http\Controllers\API\V1\FormationController;

use App\Http\Controllers\API\V1\LessonController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserController;
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
        Route::post('/', [FormationController::class, 'store']);
        Route::put('/{id}', [FormationController::class, 'update']);
        Route::delete('/{id}', [FormationController::class, 'delete']);
    });
    Route::prefix("/chapter")->group(function () {
        Route::get('/', [ChapterController::class, 'index']);
        Route::get('/{id}', [ChapterController::class, 'getById']);
        Route::post('/', [ChapterController::class, 'store']);
        Route::put('/{id}', [ChapterController::class, 'update']);
        Route::delete('/{id}', [ChapterController::class, 'delete']);
    });
    Route::prefix("/lessons")->group(function () {
        Route::apiResource('/', LessonController::class);
    });
    Route::prefix("/auth")->group(function () {
        Route::post("register", RegisterController::class);
        Route::post("login", LoginController::class);
        Route::put("/{id}", [UserController::class, 'update']);
    });
});
